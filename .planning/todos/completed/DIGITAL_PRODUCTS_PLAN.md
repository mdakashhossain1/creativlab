# Digital Products — Implementation Plan

## Overview

Extend the existing Ecommerce module to support **digital product delivery**. When a user
purchases a product flagged as digital, they receive a secure download link immediately
after payment — both in their user dashboard and in a confirmation email. Downloads remain
accessible from the dashboard indefinitely for re-download.

This plan reuses every existing piece of infrastructure:
- All 6 payment gateways already wired in `Modules/Ecommerce`
- The existing `products` / `orders` / `order_details` tables
- The existing user dashboard controller (`app/Http/Controllers/User/ProfileController.php`)
- The existing Mail pattern (`app/Mail/OrderSuccessfully.php`)

---

## What Changes vs What Is New

| Area | Action |
|---|---|
| `products` table | ADD two columns: `is_digital`, `download_url` |
| `order_details` table | ADD one column: `download_token` |
| Admin product form | ADD toggle + URL field when `is_digital = true` |
| Order completion hook | EXTEND to generate token + send digital delivery email |
| User dashboard | ADD "My Downloads" tab |
| New Mail class | `app/Mail/DigitalProductDelivery.php` |
| New download route | `GET /user/downloads/{token}` |
| Email template | `resources/views/mail/digital_product_delivery.blade.php` |

Nothing in the existing checkout, cart, or payment gateway code changes.

---

## Database Schema

### Migration 1 — Extend `products` table

```php
// File: Modules/Ecommerce/Database/Migrations/xxxx_add_digital_fields_to_products_table.php

Schema::table('products', function (Blueprint $table) {
    $table->boolean('is_digital')->default(false)->after('status');
    $table->text('download_url')->nullable()->after('is_digital');
    // download_url = the raw file link the client provides (zip, PDF, etc.)
    // Kept nullable so existing physical products are unaffected.
});
```

### Migration 2 — Extend `order_details` table

```php
// File: Modules/Ecommerce/Database/Migrations/xxxx_add_download_token_to_order_details_table.php

Schema::table('order_details', function (Blueprint $table) {
    $table->string('download_token', 64)->nullable()->unique()->after('product_id');
    // Generated only for digital product line items, null for physical.
    // This token is what appears in the dashboard URL — never the raw download_url.
});
```

**Why a token instead of the raw URL?**
The client's file URL (e.g. a Google Drive link, S3 URL, or direct .zip link) is never
exposed to the browser. Users hit `/user/downloads/{token}`, the server verifies ownership,
then redirects to the real URL. This prevents link sharing and ties every download to a
paid order.

---

## Admin Flow

### Product Creation / Edit Form Changes

File to modify: the Blade view for admin product create/edit (find via
`Modules/Ecommerce/Resources/views/admin/product/`).

Add below the existing `status` field:

```html
<!-- Digital Product Toggle -->
<div class="form-group">
    <label>Product Type</label>
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" name="is_digital"
               id="isDigital" value="1" {{ old('is_digital', $product->is_digital ?? false) ? 'checked' : '' }}>
        <label class="form-check-label" for="isDigital">This is a digital product</label>
    </div>
</div>

<!-- Download URL — shown only when toggle is on -->
<div class="form-group" id="downloadUrlField" style="display:none;">
    <label>Download URL <span class="text-danger">*</span></label>
    <input type="url" name="download_url" class="form-control"
           placeholder="https://... (zip, PDF, or any file link)"
           value="{{ old('download_url', $product->download_url ?? '') }}">
    <small class="text-muted">
        Paste the direct file link. This is never shown to buyers — they get
        a secure token link instead.
    </small>
</div>

<script>
    document.getElementById('isDigital').addEventListener('change', function () {
        document.getElementById('downloadUrlField').style.display = this.checked ? 'block' : 'none';
    });
    // Show on page load if already digital
    if (document.getElementById('isDigital').checked) {
        document.getElementById('downloadUrlField').style.display = 'block';
    }
</script>
```

### Admin Controller Changes

In `Modules/Ecommerce/Http/Controllers/Admin/ProductController.php`, add to the
`store()` and `update()` validation rules:

```php
'is_digital'   => 'nullable|boolean',
'download_url' => 'required_if:is_digital,1|nullable|url|max:2000',
```

And in the save logic:

```php
$product->is_digital   = $request->boolean('is_digital');
$product->download_url = $request->is_digital ? $request->download_url : null;
```

---

## Purchase Flow — End to End

```
User adds digital product to cart
        ↓
Existing checkout → existing payment gateway (no changes)
        ↓
Payment succeeds → existing order_status set to COMPLETED / payment_status approved
        ↓
[NEW] OrderCompletionObserver fires (or hook in existing payment success handler)
        ↓
For each OrderDetail where product->is_digital == true:
    1. Generate download_token = hash('sha256', Str::random(40))
    2. Save token to order_details.download_token
    3. Collect digital items with their tokens
        ↓
[NEW] Send DigitalProductDelivery mail to user
    - Lists each digital product purchased
    - Download button → /user/downloads/{token}
        ↓
User lands on order confirmation page (existing)
+ their dashboard now shows "My Downloads" tab with same links
```

### Where to Hook In

The safest injection point is the **existing order payment approval logic** — the same
place `order_status` is set to `COMPLETED` or `payment_status` is set to approved.
Add this call there (find the relevant method in `Modules/Ecommerce/Http/Controllers/`
payment controllers):

```php
// After order status is set to paid/completed:
$this->dispatchDigitalDelivery($order);

private function dispatchDigitalDelivery(Order $order): void
{
    $digitalItems = $order->order_detail()->with('product')
        ->whereHas('product', fn($q) => $q->where('is_digital', true))
        ->get();

    if ($digitalItems->isEmpty()) return;

    foreach ($digitalItems as $item) {
        $item->update([
            'download_token' => hash('sha256', Str::random(40))
        ]);
    }

    // Reload to get tokens
    $digitalItems = $order->order_detail()->with('product')
        ->whereHas('product', fn($q) => $q->where('is_digital', true))
        ->get();

    Mail::to($order->user->email)->send(
        new \App\Mail\DigitalProductDelivery($order, $digitalItems)
    );
}
```

---

## New Mail Class

**File:** `app/Mail/DigitalProductDelivery.php`

```php
<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Modules\Ecommerce\Entities\Order;
use Illuminate\Support\Collection;

class DigitalProductDelivery extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Order $order,
        public Collection $digitalItems
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Download Is Ready — Order #' . $this->order->id,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.digital_product_delivery',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
```

### Email Template Variables

**File:** `resources/views/mail/digital_product_delivery.blade.php`

Template variables available in the view:

| Variable | Value |
|---|---|
| `$order->id` | Order number |
| `$order->user->name` | Buyer name |
| `$order->created_at` | Purchase date |
| `$digitalItems` | Collection of OrderDetail rows |
| `$item->product->name` | Product name (via front_translate) |
| `$item->download_token` | Token for download URL |
| `route('user.download', $item->download_token)` | Full download URL |

Template structure:

```
Hi {{name}},

Thank you for your purchase (Order #{{order_id}}).

Your digital product(s) are ready to download:

┌─────────────────────────────┬──────────────┐
│ Product Name                │ Download     │
├─────────────────────────────┼──────────────┤
│ [product name]              │ [DOWNLOAD]   │
└─────────────────────────────┴──────────────┘

These links are also available any time in your dashboard at:
/user/downloads

Need help? Contact support.
```

---

## User Dashboard — "My Downloads" Section

### Controller Changes

**File:** `app/Http/Controllers/User/ProfileController.php`

Add a new method (do not touch the existing `dashboard()` method):

```php
public function downloads()
{
    $downloads = \Modules\Ecommerce\Entities\OrderDetail::with(['product', 'order'])
        ->whereHas('order', fn($q) => $q->where('user_id', auth()->id()))
        ->whereNotNull('download_token')
        ->latest()
        ->paginate(10);

    return view('user.downloads', compact('downloads'));
}
```

Add to the existing `dashboard()` method — a count badge for the nav:

```php
$digitalDownloadsCount = \Modules\Ecommerce\Entities\OrderDetail::
    whereHas('order', fn($q) => $q->where('user_id', auth()->id()))
    ->whereNotNull('download_token')
    ->count();
```

### New Route

Add to the user routes section (alongside existing `/user/subscriptions/*` routes):

```php
Route::get('/user/downloads', [ProfileController::class, 'downloads'])
     ->name('user.downloads');

Route::get('/user/downloads/{token}', [ProfileController::class, 'serveDownload'])
     ->name('user.download');
```

### Download Serve Method

```php
public function serveDownload(string $token)
{
    $item = \Modules\Ecommerce\Entities\OrderDetail::with(['product', 'order'])
        ->where('download_token', $token)
        ->whereHas('order', fn($q) => $q->where('user_id', auth()->id()))
        ->firstOrFail();  // 404 if token wrong or belongs to another user

    // Redirect to the actual file URL stored on the product
    return redirect()->away($item->product->download_url);
}
```

### Dashboard View — "My Downloads" Tab

**File:** `resources/views/user/downloads.blade.php`

Display a table with:

| Column | Source |
|---|---|
| Product Name | `$item->product->name` |
| Order # | `$item->order->id` |
| Purchase Date | `$item->order->created_at` |
| Download Button | `route('user.download', $item->download_token)` |

Each row has a **Download** button that hits `/user/downloads/{token}` → server verifies
ownership → redirects to the actual file.

---

## Email Notifications Summary

| Event | Mail Class | Template |
|---|---|---|
| Digital product purchased | `DigitalProductDelivery` | `mail.digital_product_delivery` |
| Subscription purchased (existing) | `OrderSuccessfully` | `mail.order_success_mail` |
| Installment paid (existing) | `ClientProjectInvoice` | `emails.client-project-invoice` |

---

## Routes Reference (New Routes Only)

| Method | URI | Auth | Action |
|---|---|---|---|
| GET | `/user/downloads` | auth | List all purchased digital products |
| GET | `/user/downloads/{token}` | auth | Verify token ownership → redirect to file |

---

## Module File Map (New + Modified Files)

```
Modules/Ecommerce/
└── Database/Migrations/
    ├── xxxx_add_digital_fields_to_products_table.php        [NEW]
    └── xxxx_add_download_token_to_order_details_table.php   [NEW]

app/
├── Mail/
│   └── DigitalProductDelivery.php                           [NEW]
├── Http/Controllers/User/
│   └── ProfileController.php                                [MODIFY — add downloads(), serveDownload()]

resources/views/
├── mail/
│   └── digital_product_delivery.blade.php                   [NEW]
└── user/
    └── downloads.blade.php                                   [NEW]

Modules/Ecommerce/Resources/views/admin/product/
└── create.blade.php / edit.blade.php                        [MODIFY — add digital toggle + URL field]

Modules/Ecommerce/Http/Controllers/Admin/
└── ProductController.php                                     [MODIFY — add is_digital/download_url validation]

Modules/Ecommerce/Http/Controllers/ (payment controllers)
└── [whichever file sets order complete]                      [MODIFY — call dispatchDigitalDelivery()]

Routes/
└── web.php or user route file                               [MODIFY — add 2 download routes]
```

---

## Key Design Decisions

- **Token-based access**: Raw `download_url` is never exposed to the browser. Tokens are 64-char SHA-256 hashes tied to a specific `order_detail` row and verified against the authenticated user's orders. Sharing a token with another account returns 404.
- **Permanent re-download**: Tokens do not expire. Users can download from dashboard at any time in the future.
- **Zero impact on physical products**: `is_digital` defaults `false`, `download_token` is nullable. Every existing physical product, order, and checkout flow is untouched.
- **No new payment system**: All 6 existing gateways (Stripe, PayPal, Razorpay, Paystack, Instamojo, Bank Transfer) work for digital products without any changes. Bank Transfer follows the same manual approval pattern — token is generated when admin approves, not before.
- **Client-provided URL**: Admin pastes whatever link the client provides (Google Drive, S3, Dropbox, direct .zip URL). The system does not host files.
- **Bank Transfer edge case**: Same as subscriptions — token is generated and email is sent only after admin manually approves payment at the existing approval endpoint. A `pending` bank transfer order shows no download in the dashboard yet.

---

## Implementation Order

1. **Migrations** — run both new migrations first (non-breaking, additive only)
2. **Admin product form** — add toggle + URL field, update validation in ProductController
3. **dispatchDigitalDelivery()** — hook into existing payment success handler(s)
4. **Mail class + template** — `DigitalProductDelivery` + Blade view
5. **User dashboard** — `downloads()`, `serveDownload()`, new view, new routes
6. **Test end-to-end** — create a digital product, buy it, verify email arrives, verify dashboard shows it, verify token link works, verify another user's token returns 404

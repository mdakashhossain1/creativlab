# Digital Product Shipping Bypass Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Bypass shipping validation and selection at checkout for carts containing only digital products, and ensure successful PayPal or manual admin payments trigger digital download delivery correctly.

**Architecture:** Detect if the user's cart is exclusively digital-only. If so, hide the shipping method block and delivery fee row on frontend checkouts and make address and shipping inputs nullable/optional. For completed payments, generate download tokens and dispatch delivery emails via PayPal success handlers and admin status updates.

**Tech Stack:** Laravel, PHP, Blade, jQuery.

## Global Constraints
- Laravel 9+/10+ (nwidart/laravel-modules layout).
- Database table columns `shipping_method_id` and `address` must remain non-nullable (defaulted to `0` and `"Digital Delivery"` respectively).

---

### Task 1: Checkout Controller & Frontend View Integration

**Files:**
- Modify: `landing-new/Modules/Ecommerce/Http/Controllers/CheckoutController.php`
- Modify: `landing-new/Modules/Ecommerce/Resources/views/frontend/checkout.blade.php`
- Modify: `landing-new/Modules/Ecommerce/Resources/views/frontend/payment.blade.php`

**Interfaces:**
- Consumes: `Cart` model, `ShippingMethod` model.
- Produces: `$isOnlyDigital` template variable, relaxed validation rules, and default inputs when digital-only.

- [ ] **Step 1: Update CheckoutController.php**
  Modify `index` and `processToPayment` methods to calculate `$isOnlyDigital` and update validation/defaults.
  - In `index()`:
    ```php
    $isOnlyDigital = $carts->isNotEmpty() && $carts->every(fn($cart) => $cart->product?->is_digital);
    ```
    Pass this variable to the view list.
  - In `processToPayment(Request $request)`:
    Calculate `$isOnlyDigital`, use conditional rules, and define default sanitization:
    ```php
    $carts = Cart::where('user_id', auth()->user()->id)->get();
    $isOnlyDigital = $carts->isNotEmpty() && $carts->every(fn($cart) => $cart->product?->is_digital);

    $rules = [
        'name' => 'required',
        'email' => 'required',
        'phone' => 'required',
    ];
    if (!$isOnlyDigital) {
        $rules['shipping_method_id'] = 'required';
        $rules['address'] = 'required';
    } else {
        $rules['shipping_method_id'] = 'nullable';
        $rules['address'] = 'nullable';
    }
    ```
    And sanitize data prior to setting `$orderData`:
    ```php
    $shipping_method_id = !$isOnlyDigital ? $request->shipping_method_id : 0;
    $shipping_charge = !$isOnlyDigital ? $request->shipping_charge : 0;
    $address = !$isOnlyDigital ? $request->address : ($request->address ?? 'Digital Delivery');
    ```
    And pass `$isOnlyDigital` to the payment view compact function.

- [ ] **Step 2: Update checkout.blade.php**
  Wrap the Shipping Method block in `@if(!$isOnlyDigital)` and output a hidden input if it is digital:
  ```blade
  @if(!$isOnlyDigital)
      <div class="form-box col-span-full">
          <!-- Existing Shipping Method HTML -->
      </div>
  @else
      <input type="hidden" name="shipping_method_id" value="0">
  @endif
  ```
  Add the `hidden` class to the Delivery Fee summary row:
  ```blade
  <div class="flex justify-between items-center mb-5 {{ $isOnlyDigital ? 'hidden' : '' }}">
  ```
  Update the address label:
  ```blade
  <label for="address " class="text-base mb-2">{{ __('Full Address') }} {{ $isOnlyDigital ? __('(Optional)') : '' }}</label>
  ```
  And update `parseCurrency` function:
  ```javascript
  function parseCurrency(currencyStr) {
      if (!currencyStr) return 0;
      const parsed = parseFloat(currencyStr.replace(/[^0-9.-]+/g, ''));
      return isNaN(parsed) ? 0 : parsed;
  }
  ```

- [ ] **Step 3: Update payment.blade.php**
  Wrap the Delivery Fee row in `@if(!$isOnlyDigital)`:
  ```blade
  @if(!$isOnlyDigital)
      <div class="flex justify-between items-center mb-5 ">
          <span class="text-16p text-white">{{ __('Delivery Fee') }}</span>
          <span class="text-16p text-white font-medium">(+){{ currency_pay($shipping_charge, true) }}</span>
      </div>
  @endif
  ```

- [ ] **Step 4: Verify task changes**
  Run visual validation of checkout page with empty/digital cart. Verify that no shipping selection is required and delivery charge reads `$0.00`.

- [ ] **Step 5: Commit changes**
  ```bash
  git add Modules/Ecommerce/Http/Controllers/CheckoutController.php Modules/Ecommerce/Resources/views/frontend/checkout.blade.php Modules/Ecommerce/Resources/views/frontend/payment.blade.php
  git commit -m "feat: bypass checkout shipping validation for digital-only carts"
  ```

---

### Task 2: PayPal Payment Digital Delivery Dispatch

**Files:**
- Modify: `landing-new/Modules/Ecommerce/Http/Controllers/UserPaypalController.php`

**Interfaces:**
- Consumes: PayPal transaction response, order objects.
- Produces: Generated `download_token` rows in `order_details` and dispatch email to user.

- [ ] **Step 1: Add digital delivery helper methods in UserPaypalController**
  Append `dispatchDigitalDelivery` and `buildDownloadLinksHtml` methods to `UserPaypalController.php`.
  ```php
  private function dispatchDigitalDelivery(Order $order, $user): void
  {
      $digitalItems = OrderDetail::with('singleProduct')
          ->where('order_id', $order->id)
          ->whereHas('singleProduct', fn($q) => $q->where('is_digital', true))
          ->get();

      if ($digitalItems->isEmpty()) {
          return;
      }

      foreach ($digitalItems as $item) {
          $item->update(['download_token' => hash('sha256', \Illuminate\Support\Str::random(40))]);
      }

      $digitalItems = $digitalItems->fresh('singleProduct');

      try {
          \App\Helper\EmailHelper::mail_setup();

          $template = \Modules\EmailSetting\App\Models\EmailTemplate::find(7);
          if (!$template) {
              return;
          }

          $downloadLinksHtml = $this->buildDownloadLinksHtml($digitalItems);

          $subject = str_replace('{{order_id}}', $order->order_id, $template->subject);

          $message = $template->description;
          $message = str_replace('{{name}}',           $user->name,                  $message);
          $message = str_replace('{{order_id}}',       $order->order_id,             $message);
          $message = str_replace('{{amount}}',         currency($order->total),       $message);
          $message = str_replace('{{payment_method}}', $order->payment_method,        $message);
          $message = str_replace('{{download_links}}', $downloadLinksHtml,            $message);
          $message = str_replace('{{dashboard_url}}',  url('/user/downloads'),        $message);

          \Illuminate\Support\Facades\Mail::to($user->email)->send(new \App\Mail\DigitalProductDelivery($message, $subject));
      } catch (\Exception $e) {
          \Log::error('Digital delivery mail error (paypal): ' . $e->getMessage());
      }
  }

  private function buildDownloadLinksHtml($digitalItems): string
  {
      $html  = '<table style="width:100%;border-collapse:collapse;">';
      $html .= '<thead><tr style="background:#f4f4f4;">';
      $html .= '<th style="padding:8px 12px;text-align:left;border:1px solid #e0e0e0;">Product</th>';
      $html .= '<th style="padding:8px 12px;text-align:center;border:1px solid #e0e0e0;">Download</th>';
      $html .= '</tr></thead><tbody>';

      foreach ($digitalItems as $item) {
          $productName = $item->singleProduct->translate->name ?? $item->singleProduct->slug ?? 'Product';
          $downloadUrl = url('/user/downloads/' . $item->download_token);
          $html .= '<tr>';
          $html .= '<td style="padding:10px 12px;border:1px solid #e0e0e0;">' . e($productName) . '</td>';
          $html .= '<td style="padding:10px 12px;text-align:center;border:1px solid #e0e0e0;">';
          $html .= '<a href="' . $downloadUrl . '" style="display:inline-block;padding:8px 18px;background:#794AFF;color:#fff;text-decoration:none;border-radius:5px;font-size:13px;font-weight:600;">Download</a>';
          $html .= '</td></tr>';
      }

      $html .= '</tbody></table>';
      return $html;
  }
  ```

- [ ] **Step 2: Trigger dispatchDigitalDelivery in create_order**
  Update `create_order` method in `UserPaypalController.php` (around lines 197-211) to trigger digital delivery when `$payment_status` is `Status::APPROVED`.
  ```php
      foreach ($cartItems as $item) {
          $price = $item->quantity * $item->product->finalPrice;
          $orderDetail = new OrderDetail();
          $orderDetail->order_id = $order->id;
          $orderDetail->product_id = $item->product_id;
          $orderDetail->quantity = $item->quantity;
          $orderDetail->price = $price;
          $orderDetail->save();
      }

      if ($payment_status === Status::APPROVED) {
          $this->dispatchDigitalDelivery($order, $user);
      }

      Cart::where('user_id', $user->id)->delete();
      return $order;
  ```

- [ ] **Step 3: Commit changes**
  ```bash
  git add Modules/Ecommerce/Http/Controllers/UserPaypalController.php
  git commit -m "feat: dispatch digital delivery upon successful PayPal payment"
  ```

---

### Task 3: Admin Order Controller Update

**Files:**
- Modify: `landing-new/Modules/Ecommerce/Http/Controllers/Admin/OrderController.php`

**Interfaces:**
- Consumes: Admin order status request updates.
- Produces: Triggered digital delivery dispatches when status transitions to approved.

- [ ] **Step 1: Update updateStatus in Admin OrderController.php**
  Ensure that if an admin modifies both the order and payment statuses together via `updateStatus`, digital delivery is triggered if payment status transitions to APPROVED:
  ```php
  public function updateStatus(Request $request, $id)
  {
      $order = Order::findOrFail($id);
      $wasApproved = $order->payment_status == Status::APPROVED;
      $order->order_status = $request->input('order_status');
      $order->payment_status = $request->input('payment_status');
      $order->save();

      if (!$wasApproved && $order->payment_status == Status::APPROVED) {
          $this->dispatchDigitalDelivery($order);
      }

      $notification=  trans('Status updated successfully');
      $notification=array('message'=>$notification,'alert-type'=>'success');

      return back()->with($notification);
  }
  ```

- [ ] **Step 2: Commit changes**
  ```bash
  git add Modules/Ecommerce/Http/Controllers/Admin/OrderController.php
  git commit -m "fix: trigger digital product delivery when admin updates payment status to approved via updateStatus"
  ```

# ArknoxMonitor

A Laravel module that silently tracks database activity, Cloudflare R2 storage usage, and generates monthly billing invoices — all exposed via a token-protected JSON API.

---

## Quick Start

### 1 — Set the secret token

Add to **both** local and production `.env`:

```env
ARKNOX_MONITOR_SECRET=your-long-random-secret-here
```

Without this, every API call returns `401 Unauthorized`.

### 2 — Run migrations

```bash
php artisan migrate
```

Creates five tables: `arknox_usage_daily`, `arknox_usage_monthly`, `arknox_invoices`, `arknox_r2_daily`, `arknox_r2_monthly`.

### 3 — Add R2 credentials (if using R2 tracking)

```env
CLOUDFLARE_R2_ACCESS_KEY_ID=your_key_id
CLOUDFLARE_R2_SECRET_ACCESS_KEY=your_secret_key
CLOUDFLARE_R2_BUCKET=your-bucket-name
CLOUDFLARE_R2_ENDPOINT=https://<account_id>.r2.cloudflarestorage.com
CLOUDFLARE_R2_PUBLIC_URL=https://pub-<hash>.r2.dev
```

---

## Authentication

Every request must include the token as a header:

```
X-Monitor-Token: your-long-random-secret-here
```

Any request missing or with a wrong token gets:
```json
{ "error": "Unauthorized" }
```
with HTTP status `401`.

---

## All Endpoints

Base URL: `https://creativlab.in/api/arknox-monitor`

### Database & Health

| Method | Path | Description |
|--------|------|-------------|
| GET | `/health` | DB ping, connection status, response time |
| GET | `/usage` | Monthly DB request count + response times |
| GET | `/usage/daily` | Per-day request counts |

### Billing / Invoices

| Method | Path | Description |
|--------|------|-------------|
| GET | `/invoice` | Get (or auto-generate) invoice for a month |
| GET | `/invoices` | Full invoice history, all months |
| POST | `/invoice/generate` | Manually snapshot an invoice |
| POST | `/invoice/mark-paid` | Mark invoice as paid |
| POST | `/invoice/mark-unpaid` | Mark invoice as unpaid / overdue |

### Cloudflare R2 Storage

| Method | Path | Description |
|--------|------|-------------|
| GET | `/r2/usage` | Monthly upload/download ops + bytes |
| GET | `/r2/usage/daily` | Per-day R2 breakdown |
| GET | `/r2/estimate` | Cost estimate vs R2 free tier |
| GET | `/r2/summary` | All-time R2 totals across all months |
| GET | `/r2/live` | In-flight R2 ops for the current request |

---

## Endpoint Reference

### `GET /health`

```json
{
    "success": true,
    "status": "healthy",
    "ping_ms": 1.24,
    "database": "creative",
    "driver": "mysql",
    "host": "127.0.0.1",
    "checked_at": "2026-06-29T10:00:00+00:00"
}
```
Returns HTTP `503` if the DB is unreachable.

---

### `GET /usage?year=2026&month=6`

```json
{
    "success": true,
    "period": { "year": 2026, "month": 6 },
    "request_count": 18420,
    "total_time_ms": 9843,
    "avg_response_ms": 0.53,
    "current_request": { "query_count": 12, "total_time_ms": 6.2 }
}
```
`current_request` shows the in-memory buffer for the live request (not yet flushed to DB).

---

### `GET /usage/daily?days=30`

```json
{
    "success": true,
    "days": 30,
    "daily": [
        { "date": "2026-06-29", "request_count": 1204, "total_time_ms": 620, "avg_response_ms": 0.51 },
        { "date": "2026-06-28", "request_count": 987,  "total_time_ms": 501, "avg_response_ms": 0.51 }
    ]
}
```

---

### `GET /invoice?year=2026&month=6`

```json
{
    "success": true,
    "invoice": {
        "period": { "year": 2026, "month": 6 },
        "query_count": 18420,
        "free_quota": 0,
        "overage_queries": 18420,
        "base_rent_usd": 7.00,
        "overage_rate_usd": 0.001,
        "overage_amount": 18.42,
        "total_usd": 25.42,
        "status": "pending",
        "paid_at": null
    }
}
```

**Invoice status values:** `pending` · `paid` · `unpaid`

---

### `GET /invoices`

```json
{
    "success": true,
    "invoices": [
        {
            "period": { "year": 2026, "month": 6 },
            "total_usd": 25.42,
            "status": "paid",
            "paid_at": "2026-07-01T09:00:00.000000Z"
        },
        {
            "period": { "year": 2026, "month": 5 },
            "total_usd": 7.00,
            "status": "paid",
            "paid_at": "2026-06-02T14:22:00.000000Z"
        }
    ]
}
```

---

### `POST /invoice/generate`

**Body:**
```json
{ "year": 2026, "month": 6 }
```

Safe to call multiple times — returns existing invoice if already generated.

---

### `POST /invoice/mark-paid`

**Body:**
```json
{ "year": 2026, "month": 6 }
```

**Response:**
```json
{ "success": true, "invoice": { "status": "paid", "paid_at": "2026-07-01T09:00:00.000000Z" } }
```

---

### `POST /invoice/mark-unpaid`

**Body:**
```json
{ "year": 2026, "month": 6 }
```

Clears `paid_at`, sets status to `unpaid`.

---

### `GET /r2/usage?year=2026&month=6`

```json
{
    "success": true,
    "period": { "year": 2026, "month": 6 },
    "usage": {
        "class_a_ops": 124,
        "class_b_ops": 540,
        "bytes_uploaded": 52428800,
        "mb_uploaded": 50.0,
        "gb_uploaded": 0.0488,
        "bytes_downloaded": 0,
        "mb_downloaded": 0.0,
        "files_added": 124,
        "files_deleted": 3
    },
    "estimate": {
        "storage_gb_used": 0.0488,
        "storage_gb_free": 10,
        "storage_cost_usd": 0.0,
        "class_a_used": 124,
        "class_a_free": 1000000,
        "class_a_cost_usd": 0.0,
        "total_estimated_usd": 0.0,
        "within_free_tier": true
    }
}
```

---

### `GET /r2/estimate?year=2026&month=6`

Same as `r2/usage` but also includes full free-tier thresholds and per-unit pricing in the response.

**R2 free tier:** 10 GB storage · 1M Class A ops (PUT/DELETE/LIST) · 10M Class B ops (GET/HEAD) · egress always free.

---

### `GET /r2/usage/daily?days=30`

```json
{
    "success": true,
    "days": 30,
    "daily": [
        {
            "date": "2026-06-29",
            "class_a_ops": 12,
            "class_b_ops": 45,
            "bytes_uploaded": 5242880,
            "mb_uploaded": 5.0,
            "mb_downloaded": 0.0,
            "files_added": 12,
            "files_deleted": 0
        }
    ]
}
```

---

### `GET /r2/summary`

All-time totals across every recorded month:

```json
{
    "success": true,
    "all_time": {
        "months_tracked": 2,
        "total_class_a_ops": 248,
        "total_class_b_ops": 1080,
        "total_bytes_uploaded": 104857600,
        "total_gb_uploaded": 0.0977,
        "total_bytes_downloaded": 0,
        "estimated_net_files": 241
    }
}
```

---

### `GET /r2/live`

Shows R2 ops buffered in the current HTTP request (not yet flushed to DB):

```json
{
    "success": true,
    "current_request": {
        "class_a_ops": 1,
        "class_b_ops": 0,
        "bytes_uploaded": 204800,
        "bytes_downloaded": 0,
        "files_added": 1,
        "files_deleted": 0
    }
}
```

---

## Billing Calculation

```
total = base_rent + max(0, query_count - free_queries) × overage_rate
```

Current defaults (`config/config.php`):

| Setting | Value |
|---------|-------|
| `base_rent` | $7.00 / month |
| `free_queries` | 0 |
| `overage_rate` | $0.001 per request |

**Example:**
- 500 requests → $7.00 + (500 × $0.001) = **$7.50**
- 5,000 requests → $7.00 + (5,000 × $0.001) = **$12.00**

---

## Integration Guide — Calling from Another Website

### Laravel (Http facade)

Add to your **other site's** `.env`:
```env
ARKNOX_SECRET=your-long-random-secret-here
ARKNOX_BASE_URL=https://creativlab.in/api/arknox-monitor
```

Then call any endpoint:

```php
use Illuminate\Support\Facades\Http;

$base   = config('services.arknox.base_url', env('ARKNOX_BASE_URL'));
$secret = config('services.arknox.secret',   env('ARKNOX_SECRET'));

$headers = ['X-Monitor-Token' => $secret];

// Health check
$health = Http::withHeaders($headers)->get("{$base}/health")->json();

// Current month invoice
$invoice = Http::withHeaders($headers)
    ->get("{$base}/invoice", ['year' => now()->year, 'month' => now()->month])
    ->json();

// All invoices
$invoices = Http::withHeaders($headers)->get("{$base}/invoices")->json();

// R2 usage this month
$r2 = Http::withHeaders($headers)
    ->get("{$base}/r2/usage", ['year' => now()->year, 'month' => now()->month])
    ->json();

// Mark paid after receiving payment webhook
Http::withHeaders($headers)
    ->post("{$base}/invoice/mark-paid", ['year' => 2026, 'month' => 6]);
```

### Plain PHP

```php
function arknox(string $path, string $method = 'GET', array $body = []): array
{
    $base   = 'https://creativlab.in/api/arknox-monitor';
    $secret = 'your-long-random-secret-here';

    $ctx = stream_context_create(['http' => [
        'method'        => $method,
        'header'        => "Content-Type: application/json\r\nX-Monitor-Token: {$secret}",
        'content'       => $body ? json_encode($body) : null,
        'ignore_errors' => true,
    ]]);

    return json_decode(file_get_contents("{$base}/{$path}", false, $ctx), true);
}

// Examples
$health   = arknox('health');
$invoices = arknox('invoices');
$r2       = arknox('r2/usage?year=2026&month=6');

arknox('invoice/mark-paid', 'POST', ['year' => 2026, 'month' => 6]);
```

### JavaScript (server-side / Node.js only — never expose secret in browser)

```javascript
const BASE   = 'https://creativlab.in/api/arknox-monitor';
const SECRET = process.env.ARKNOX_SECRET;

async function arknox(path, method = 'GET', body = null) {
    const res = await fetch(`${BASE}/${path}`, {
        method,
        headers: {
            'Content-Type': 'application/json',
            'X-Monitor-Token': SECRET,
        },
        body: body ? JSON.stringify(body) : undefined,
    });
    return res.json();
}

const health   = await arknox('health');
const invoices = await arknox('invoices');
const r2       = await arknox('r2/usage?year=2026&month=6');

await arknox('invoice/mark-paid', 'POST', { year: 2026, month: 6 });
```

---

## Recommended Billing Dashboard Flow

```
1. On page load
       GET /invoices                 → show invoice list with status badges

2. User selects a month
       GET /invoice?year=&month=     → show line-item detail

3. User pays (Razorpay / Stripe on your dashboard site)
       On payment webhook success:
       POST /invoice/mark-paid       → { year, month }

4. R2 section
       GET /r2/usage?year=&month=    → show upload/download stats
       GET /r2/estimate?year=&month= → show cost vs free tier

5. Live health widget (poll every 60s)
       GET /health                   → green/red indicator
```

---

## Configuration Reference

`Modules/ArknoxMonitor/config/config.php`

```php
return [
    'route_prefix'        => 'arknox-monitor',
    'secret'              => env('ARKNOX_MONITOR_SECRET'),

    'base_rent'           => 7.00,
    'free_queries'        => 0,
    'overage_rate'        => 0.001,
    'exclude_connections' => [],
    'exclude_paths'       => ['cron/run', 'api/attendance'],

    'r2' => [
        'disk'             => 'r2',
        'bucket'           => env('CLOUDFLARE_R2_BUCKET', 'arknox-technology'),
        'public_url'       => env('CLOUDFLARE_R2_PUBLIC_URL'),
        'free_storage_gb'  => 10,
        'free_class_a_ops' => 1_000_000,
        'free_class_b_ops' => 10_000_000,
        'price_storage_gb' => 0.015,
        'price_class_a'    => 4.50,
        'price_class_b'    => 0.36,
    ],
];
```

---

## Module Structure

```
Modules/ArknoxMonitor/
├── config/config.php
├── routes/api.php
├── Database/migrations/
│   ├── ..._create_arknox_usage_daily_table.php
│   ├── ..._create_arknox_usage_monthly_table.php
│   ├── ..._create_arknox_invoices_table.php
│   ├── 2026_06_29_000004_create_arknox_r2_daily_table.php
│   └── 2026_06_29_000005_create_arknox_r2_monthly_table.php
└── App/
    ├── Providers/
    │   ├── ArknoxMonitorServiceProvider.php
    │   └── RouteServiceProvider.php
    ├── Http/Controllers/
    │   ├── MonitorController.php     ← health, usage, invoices
    │   └── R2Controller.php          ← r2/* endpoints
    └── Services/
        ├── QueryBuffer.php           ← buffers DB query stats, flushes at request end
        ├── R2UsageBuffer.php         ← buffers R2 ops, flushes at request end
        ├── R2StorageService.php      ← wraps Storage::disk('r2'), auto-tracks ops
        ├── HealthChecker.php         ← DB ping
        └── BillingEngine.php         ← invoice CRUD
```

---

## DB Tables

| Table | Unique key | Tracked columns |
|-------|-----------|-----------------|
| `arknox_usage_daily` | `date` | `query_count`, `total_time_ms` |
| `arknox_usage_monthly` | `year + month` | `query_count`, `total_time_ms` |
| `arknox_invoices` | `year + month` | `total_amount`, `status`, `paid_at` |
| `arknox_r2_daily` | `date` | `class_a_ops`, `class_b_ops`, `bytes_uploaded`, `bytes_downloaded`, `files_added`, `files_deleted` |
| `arknox_r2_monthly` | `year + month` | same as above |

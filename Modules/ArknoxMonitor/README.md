# ArknoxMonitor — Laravel Database Usage Monitor

A plug-and-play Laravel module that silently tracks your site's own database activity — query counts, execution time, health, and monthly billing — with zero code changes required in your application.

---

## How It Works

Once installed, the module hooks into Laravel's built-in `DB::listen()` event at boot time. Every SQL query your application runs is counted and timed in memory. At the very end of each HTTP request, the buffer is flushed to two tracking tables using a single atomic `INSERT ... ON DUPLICATE KEY UPDATE`. This means:

- **Zero overhead per query** — no DB write happens mid-request
- **No recursion** — the flush itself is excluded from tracking
- **No code changes** — works with all Eloquent models, raw queries, and query builder calls automatically

---

## Requirements

- PHP 8.1+
- Laravel 10+
- `nwidart/laravel-modules` installed in the project
- MySQL / MariaDB (uses `ON DUPLICATE KEY UPDATE`)

---

## Installation

### Step 1 — Copy the module

Copy the `ArknoxMonitor` folder into your project's `Modules/` directory:

```
your-laravel-project/
└── Modules/
    └── ArknoxMonitor/      ← paste here
```

### Step 2 — Enable the module

```bash
php artisan module:enable ArknoxMonitor
```

### Step 3 — Run migrations

```bash
php artisan migrate
```

This creates three tables:
- `arknox_usage_daily` — per-day query stats
- `arknox_usage_monthly` — per-month aggregated stats
- `arknox_invoices` — generated monthly invoices with paid/unpaid status

### Step 4 — Clear config cache

```bash
php artisan config:clear
```

That's it. The module is now active and tracking starts immediately.

---

## Configuration

All configuration lives inside the module at `Modules/ArknoxMonitor/config/config.php`. Edit that file directly to change any value — no `.env` entries needed anywhere.

| Key | Default | Description |
|-----|---------|-------------|
| `route_prefix` | `arknox-monitor` | URL prefix for all endpoints |
| `base_rent` | `7.00` | Base monthly charge in USD |
| `free_queries` | `10000` | Free queries included per month |
| `overage_rate` | `0.0001` | USD per extra query over quota |
| `exclude_connections` | `[]` | DB connection names to skip tracking |

---

## API Endpoints

Base URL: `https://your-site.com/{ARKNOX_MONITOR_PREFIX}`

Default prefix: `/arknox-monitor`

---

### Health

#### `GET /arknox-monitor/health`

Checks if the database connection is alive and measures ping time.

**Response — healthy:**
```json
{
    "success": true,
    "status": "healthy",
    "ping_ms": 1.24,
    "database": "my_database",
    "driver": "mysql",
    "host": "127.0.0.1",
    "checked_at": "2026-06-24T10:00:00+00:00"
}
```

**Response — unhealthy (HTTP 503):**
```json
{
    "success": false,
    "status": "unhealthy",
    "error": "SQLSTATE[HY000] [2002] Connection refused",
    "ping_ms": null,
    "checked_at": "2026-06-24T10:00:00+00:00"
}
```

---

### Usage

#### `GET /arknox-monitor/usage`

Returns query statistics for a specific month.

**Query Parameters:**

| Parameter | Type | Default | Description |
|-----------|------|---------|-------------|
| `year` | integer | current year | Year to query |
| `month` | integer | current month | Month to query (1–12) |

**Example:**
```
GET /arknox-monitor/usage?year=2026&month=6
```

**Response:**
```json
{
    "success": true,
    "period": { "year": 2026, "month": 6 },
    "query_count": 18420,
    "total_time_ms": 9843,
    "avg_query_ms": 0.53,
    "in_buffer": {
        "buffered_queries": 12,
        "buffered_time_ms": 6.2
    }
}
```

> `in_buffer` shows queries counted in the current request that haven't been flushed to the DB yet.

---

#### `GET /arknox-monitor/usage/daily`

Returns a day-by-day breakdown of query activity.

**Query Parameters:**

| Parameter | Type | Default | Description |
|-----------|------|---------|-------------|
| `days` | integer | `30` | How many past days to return (max 365) |

**Example:**
```
GET /arknox-monitor/usage/daily?days=7
```

**Response:**
```json
{
    "success": true,
    "days": 7,
    "daily": [
        {
            "date": "2026-06-24",
            "query_count": 1204,
            "total_time_ms": 620,
            "avg_query_ms": 0.51
        },
        {
            "date": "2026-06-23",
            "query_count": 987,
            "total_time_ms": 501,
            "avg_query_ms": 0.51
        }
    ]
}
```

---

### Invoices

#### `GET /arknox-monitor/invoice`

Returns the invoice for a specific month. If no invoice record exists yet, it is automatically generated and saved.

**Query Parameters:**

| Parameter | Type | Default | Description |
|-----------|------|---------|-------------|
| `year` | integer | current year | Year |
| `month` | integer | current month | Month (1–12) |

**Example:**
```
GET /arknox-monitor/invoice?year=2026&month=6
```

**Response:**
```json
{
    "success": true,
    "invoice": {
        "period": { "year": 2026, "month": 6 },
        "query_count": 18420,
        "total_time_ms": 9843,
        "avg_query_ms": 0.53,
        "free_quota": 10000,
        "overage_queries": 8420,
        "base_rent_usd": 7.00,
        "overage_rate_usd": 0.0001,
        "overage_amount": 0.842,
        "total_usd": 7.842,
        "status": "pending",
        "paid_at": null
    }
}
```

**Invoice status values:**

| Status | Meaning |
|--------|---------|
| `pending` | Generated but not yet reviewed |
| `paid` | Marked as paid |
| `unpaid` | Marked as overdue / unpaid |

---

#### `GET /arknox-monitor/invoices`

Returns the full invoice history for all months.

**Response:**
```json
{
    "success": true,
    "invoices": [
        {
            "period": { "year": 2026, "month": 6 },
            "query_count": 18420,
            "total_time_ms": 9843,
            "avg_query_ms": 0.53,
            "free_quota": 10000,
            "overage_queries": 8420,
            "base_rent_usd": 7.00,
            "overage_amount": 0.842,
            "total_usd": 7.842,
            "status": "paid",
            "paid_at": "2026-06-01T09:00:00.000000Z"
        },
        {
            "period": { "year": 2026, "month": 5 },
            "query_count": 6200,
            "total_time_ms": 3100,
            "avg_query_ms": 0.50,
            "free_quota": 10000,
            "overage_queries": 0,
            "base_rent_usd": 7.00,
            "overage_amount": 0.00,
            "total_usd": 7.00,
            "status": "paid",
            "paid_at": "2026-05-03T14:22:00.000000Z"
        }
    ]
}
```

---

#### `POST /arknox-monitor/invoice/generate`

Manually generate and save an invoice for a specific month. Useful for end-of-month snapshots. Safe to call multiple times — returns the existing invoice if already generated.

**Request Body (JSON):**
```json
{
    "year": 2026,
    "month": 6
}
```

**Response:**
```json
{
    "success": true,
    "invoice": {
        "period": { "year": 2026, "month": 6 },
        "query_count": 18420,
        "total_usd": 7.842,
        "status": "pending",
        "paid_at": null
    }
}
```

---

#### `POST /arknox-monitor/invoice/mark-paid`

Mark an invoice as paid and record the payment timestamp.

**Request Body (JSON):**
```json
{
    "year": 2026,
    "month": 6
}
```

**Response:**
```json
{
    "success": true,
    "invoice": {
        "period": { "year": 2026, "month": 6 },
        "total_usd": 7.842,
        "status": "paid",
        "paid_at": "2026-06-24T10:30:00.000000Z"
    }
}
```

---

#### `POST /arknox-monitor/invoice/mark-unpaid`

Mark an invoice as unpaid (overdue). Clears the `paid_at` timestamp.

**Request Body (JSON):**
```json
{
    "year": 2026,
    "month": 6
}
```

**Response:**
```json
{
    "success": true,
    "invoice": {
        "period": { "year": 2026, "month": 6 },
        "total_usd": 7.842,
        "status": "unpaid",
        "paid_at": null
    }
}
```

---

## Billing Calculation

```
monthly_total = base_rent + overage_amount

overage_amount = max(0, query_count - free_queries) × overage_rate
```

**Example with defaults:**

| Queries | Overage | Total |
|---------|---------|-------|
| 5,000 | 0 | $7.00 |
| 10,000 | 0 | $7.00 |
| 15,000 | 5,000 × $0.0001 = $0.50 | $7.50 |
| 50,000 | 40,000 × $0.0001 = $4.00 | $11.00 |

All rates are configurable via `.env`.

---

## Database Tables

### `arknox_usage_daily`

| Column | Type | Description |
|--------|------|-------------|
| `id` | bigint | Primary key |
| `date` | date | The calendar date (unique) |
| `query_count` | bigint | Total queries executed on this day |
| `total_time_ms` | bigint | Total execution time in milliseconds |
| `created_at` | timestamp | |
| `updated_at` | timestamp | |

### `arknox_usage_monthly`

| Column | Type | Description |
|--------|------|-------------|
| `id` | bigint | Primary key |
| `year` | smallint | Year |
| `month` | tinyint | Month (1–12) |
| `query_count` | bigint | Total queries this month |
| `total_time_ms` | bigint | Total execution time in milliseconds |
| `created_at` | timestamp | |
| `updated_at` | timestamp | |

### `arknox_invoices`

| Column | Type | Description |
|--------|------|-------------|
| `id` | bigint | Primary key |
| `year` | smallint | Year |
| `month` | tinyint | Month (1–12) |
| `query_count` | bigint | Query count snapshot at invoice generation |
| `base_rent` | decimal(10,4) | Base charge in USD |
| `overage_amount` | decimal(10,4) | Extra charge for queries over quota |
| `total_amount` | decimal(10,4) | Final total in USD |
| `status` | enum | `pending` / `paid` / `unpaid` |
| `paid_at` | timestamp | When it was marked paid (nullable) |
| `created_at` | timestamp | |
| `updated_at` | timestamp | |

---

## All Endpoints — Quick Reference

| Method | Endpoint | Description |
|--------|----------|-------------|
| `GET` | `/arknox-monitor/health` | Database health check + ping time |
| `GET` | `/arknox-monitor/usage` | Monthly query stats (`?year=&month=`) |
| `GET` | `/arknox-monitor/usage/daily` | Daily breakdown (`?days=30`) |
| `GET` | `/arknox-monitor/invoice` | Get/auto-generate invoice (`?year=&month=`) |
| `GET` | `/arknox-monitor/invoices` | Full invoice history |
| `POST` | `/arknox-monitor/invoice/generate` | Generate invoice snapshot `{year, month}` |
| `POST` | `/arknox-monitor/invoice/mark-paid` | Mark invoice paid `{year, month}` |
| `POST` | `/arknox-monitor/invoice/mark-unpaid` | Mark invoice unpaid `{year, month}` |

---

## Module File Structure

```
Modules/ArknoxMonitor/
├── module.json
├── config/
│   └── config.php
├── routes/
│   └── api.php
├── Database/
│   └── migrations/
│       ├── ..._create_arknox_usage_daily_table.php
│       ├── ..._create_arknox_usage_monthly_table.php
│       └── ..._create_arknox_invoices_table.php
└── App/
    ├── Providers/
    │   ├── ArknoxMonitorServiceProvider.php
    │   └── RouteServiceProvider.php
    ├── Http/
    │   └── Controllers/
    │       └── MonitorController.php
    └── Services/
        ├── QueryBuffer.php      ← listens + buffers + flushes query stats
        ├── HealthChecker.php    ← DB ping and connection check
        └── BillingEngine.php   ← invoice generation and status management
```

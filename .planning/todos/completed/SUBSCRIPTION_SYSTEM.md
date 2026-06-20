# Subscription System — Implementation Report

## Architecture Overview

The subscription system is a Laravel modular architecture split into two parallel billing tracks:

1. **Subscription Plans** — Users purchase tiered plans (monthly/yearly/lifetime)
2. **Client Projects** — Admin creates project contracts with installment-based billing
3. **Digital Products** — One-time product purchases that deliver a secure download link immediately after payment *(planned — see [DIGITAL_PRODUCTS_PLAN.md](DIGITAL_PRODUCTS_PLAN.md))*

---

## Database Schema

### `subscription_plans`
Stores the available tiers users can purchase.

| Column | Type | Notes |
|---|---|---|
| `plan_name` | string | Display name |
| `plan_price` | decimal | Purchase price |
| `expiration_date` | enum | `monthly`, `yearly`, `lifetime` |
| `features` | JSON | Feature list |
| `status` | enum | `active` / `inactive` |
| `serial` | int | Display ordering |

### `subscription_histories`
Every purchase attempt is recorded here, one row per transaction.

| Column | Type | Notes |
|---|---|---|
| `order_id` | string | Timestamp + random (e.g. `1707922781234`) |
| `user_id` | FK | Buyer |
| `subscription_plan_id` | FK | Plan purchased |
| `plan_info` | JSON | Snapshot of plan at purchase time |
| `expiration_date` | datetime | Calculated on payment approval |
| `expiration` | string | `monthly` / `yearly` / `lifetime` |
| `status` | enum | `active` / `inactive` / `pending` / `expired` |
| `payment_method` | string | `stripe`, `paypal`, `bank`, etc. |
| `payment_status` | enum | `success` / `pending` / `failed` |
| `transaction` | string | Gateway transaction ID |

### `client_projects`
Admin-created project contracts.

| Column | Type | Notes |
|---|---|---|
| `payment_type` | enum | `split` or `monthly` |
| `monthly_amount` | decimal | Used by cron for monthly type |
| `gst_enabled` | boolean | Whether GST applies |
| `gst_percent` | decimal | GST rate |
| `status` | enum | `active` / `paused` / `completed` |

### `client_project_installments`
Individual payment milestones.

| Column | Type | Notes |
|---|---|---|
| `invoice_number` | string | Unique, sent in email |
| `base_amount` | decimal | Pre-GST amount |
| `gst_amount` | decimal | GST portion |
| `total_amount` | decimal | What user pays |
| `due_date` | date | When payment is due |
| `status` | enum | `pending` / `paid` / `overdue` |
| `paid_at` | timestamp | Set on payment |

---

## End-to-End Subscription Purchase Flow

```
User picks plan
      ↓
GET /subscription/checkout
  → Shows all active plans from subscription_plans
      ↓
GET /subscription/process-to-payment
  → Validates plan, stores order in session (subscriptionOrderData)
  → Redirects to payment method selector
      ↓
User picks payment method
      ↓
POST /subscription/{gateway}
  → Gateway processes payment
  → On success: create_subscription() called
      ↓
create_subscription()
  → Generates order_id
  → Calculates expiration_date:
      monthly  → +1 month
      yearly   → +1 year
      lifetime → +100 years
  → Saves SubscriptionHistory row
  → Sends OrderSuccessfully email (Template ID 6)
  → Clears session
      ↓
User lands on history page: /user/subscriptions/history
```

**Bank Transfer exception**: Payment status is set to `pending`, no expiration is calculated. Admin manually approves at `POST /admin/purchase-history-payment-approved/{id}`, which then sets `payment_status=success`, `status=active`, and calculates the expiration date.

---

## Payment Gateways

All credentials are stored in the `payment_gateways` database table (not `.env`), as key-value pairs configurable via admin UI.

| Gateway | Type | Flow |
|---|---|---|
| **Stripe** | Card | Direct charge, synchronous |
| **PayPal** | Wallet | Order create → capture (via `srmklive/paypal`) |
| **Razorpay** | Indian | Redirect + server-side verification |
| **Paystack** | African | Redirect + verification callback |
| **Instamojo** | Indian | Redirect + `instamojo_response` callback |
| **Bank Transfer** | Manual | Creates `pending` record, admin approves |

Both the Subscription track and the Client Project installment track support **all 6 gateways** via their own parallel controller sets.

---

## Client Project Billing Flow

```
Admin creates project (POST /admin/client-projects)
      ↓
  payment_type = split?
    → Admin provides installment amounts + due dates
    → System creates ClientProjectInstallment rows immediately

  payment_type = monthly?
    → System creates first installment immediately
    → Cron generates future installments daily
      ↓
User sees project at /user/client-projects/{id}
User clicks "Pay" on a pending installment
      ↓
GET /user/client-projects/pay/{installmentId}
  → Validates user owns project
  → Validates installment is pending
  → Stores clientProjectOrderData in session
      ↓
User picks gateway → payment processed
      ↓
recordPayment()
  → Updates installment: status=paid, paid_at=now, invoice_number generated
  → Sends ClientProjectInvoice email
      ↓
Admin can also approve: POST /admin/client-projects/installment/{id}/approve
```

---

## Scheduled Task (Cron)

**Command**: `installments:generate-monthly`
**Schedule**: Daily at 00:01 AM

Two jobs per run:

1. **Mark overdue**: Any installment where `due_date < today` and `status = pending` → set `status = overdue`
2. **Generate monthly installments**: For each active `monthly`-type project, check if an installment for the current month already exists. If not, create one using `project->monthly_amount` with optional GST applied.

---

## Email Notifications

| Event | Mail Class | Template |
|---|---|---|
| Subscription purchased | `OrderSuccessfully` | DB Template #6 |
| Installment paid | `ClientProjectInvoice` | Blade view `emails.client-project-invoice` |

`OrderSuccessfully` supports template variable substitution:
`{{name}}`, `{{amount}}`, `{{order_id}}`, `{{plan_name}}`, `{{payment_method}}`, `{{payment_status}}`, `{{expiration_date}}`, `{{transaction}}`

---

## Module File Map

```
Modules/Subscription/
├── Database/Migrations/
│   ├── create_subscription_plans_table.php
│   ├── create_subscription_histories_table.php
│   ├── create_client_projects_table.php
│   └── create_client_project_installments_table.php
├── Entities/
│   ├── SubscriptionPlan.php
│   ├── SubscriptionHistory.php
│   ├── ClientProject.php
│   └── ClientProjectInstallment.php
├── Http/Controllers/
│   ├── Admin/
│   │   ├── SubscriptionPlanController.php    (plan CRUD)
│   │   ├── SubscriptionLogController.php     (history + manual approval)
│   │   └── ClientProjectController.php       (projects + installment approval)
│   ├── SubscriptionPurchase/
│   │   ├── SubscriptionCheckoutController.php
│   │   ├── SubscriptionPaymentController.php (5 gateways + bank)
│   │   ├── UserPaypalSubscriptionController.php
│   │   ├── ClientProjectCheckoutController.php
│   │   └── ClientProjectPaymentController.php (5 gateways + bank)
│   └── User/
│       ├── SubscriptionHistory.php
│       └── ClientProjectUserController.php
└── Routes/
    └── web.php

app/Console/Commands/
└── GenerateMonthlyInstallments.php

app/Mail/
├── OrderSuccessfully.php
└── ClientProjectInvoice.php

Modules/PaymentGateway/
├── App/Models/PaymentGateway.php
└── Database/migrations/create_payment_gateways_table.php
```

---

## Routes Reference

### Admin Routes (`/admin`, auth:admin)

| Method | URI | Action |
|---|---|---|
| GET | `/admin/subscription-plan` | List plans |
| POST | `/admin/subscription-plan` | Create plan |
| GET | `/admin/subscription-plan/create` | Create form |
| GET | `/admin/subscription-plan/{id}/edit` | Edit form |
| PATCH | `/admin/subscription-plan/{id}` | Update plan |
| DELETE | `/admin/subscription-plan/{id}` | Delete plan |
| GET | `/admin/purchase-history` | All subscription history |
| GET | `/admin/pending-purchase-history` | Pending only |
| GET | `/admin/purchase-history-detail/{id}` | History detail |
| DELETE | `/admin/purchase-history-destroy/{id}` | Delete record |
| POST | `/admin/purchase-history-payment-approved/{id}` | Approve bank payment |
| GET | `/admin/client-projects` | List projects |
| POST | `/admin/client-projects` | Create project |
| GET | `/admin/client-projects/{id}` | View project |
| PATCH | `/admin/client-projects/{id}` | Update project |
| DELETE | `/admin/client-projects/{id}` | Delete project |
| POST | `/admin/client-projects/{id}/toggle-status` | Toggle active/paused |
| POST | `/admin/client-projects/installment/{id}/approve` | Approve installment |

### User Routes

| Method | URI | Action |
|---|---|---|
| GET | `/subscription/checkout` | Plan selector |
| GET | `/subscription/process-to-payment` | Store session, redirect |
| POST | `/subscription/stripe` | Pay via Stripe |
| POST | `/subscription/bank` | Pay via bank transfer |
| GET | `/subscription/paypal` | Initiate PayPal |
| GET | `/subscription/paypal-success-payment` | PayPal success callback |
| GET | `/subscription/paypal-failed-payment` | PayPal failure callback |
| POST | `/subscription/pay-razorpay` | Pay via Razorpay |
| GET | `/subscription/pay-via-paystack` | Pay via Paystack |
| GET | `/subscription/pay-via-instamojo` | Pay via Instamojo |
| GET | `/subscription/response-instamojo` | Instamojo callback |
| GET | `/user/subscriptions/history` | User's subscription list |
| GET | `/user/subscriptions/{order_id}` | Subscription detail |
| GET | `/user/client-projects/` | User's projects |
| GET | `/user/client-projects/{id}` | Project detail |
| GET | `/user/client-projects/pay/{installmentId}` | Pay installment |
| POST | `/user/client-projects/stripe` | Installment via Stripe |
| POST | `/user/client-projects/bank` | Installment via bank |
| GET | `/user/client-projects/paypal` | Installment via PayPal |
| POST | `/user/client-projects/razorpay` | Installment via Razorpay |
| GET | `/user/client-projects/paystack` | Installment via Paystack |
| GET | `/user/client-projects/instamojo` | Installment via Instamojo |

---

## Key Design Decisions

- **Session-based checkout**: Order data is passed between steps via `session()`, not URL params. Cleared after successful payment.
- **Plan snapshot in JSON**: `plan_info` column stores a JSON copy of the plan at purchase time so plan edits don't corrupt historical records.
- **No auto-renewal**: Subscriptions do not auto-renew. Users must manually repurchase. No webhook listener for recurring billing.
- **Admin-controlled approvals**: Bank transfers require explicit admin approval before the subscription activates.
- **Dual billing tracks are fully parallel**: Subscription plans and client project installments share the same payment gateways but use completely separate controller stacks, sessions, and database tables.
- **DB-stored gateway credentials**: Payment API keys are stored in `payment_gateways` table, not `.env`, making them configurable from the admin panel without a deployment.

---

## Related Plans

- [DIGITAL_PRODUCTS_PLAN.md](DIGITAL_PRODUCTS_PLAN.md) — Planned third billing track: one-time digital product purchases with secure token-based download delivery to dashboard and email.

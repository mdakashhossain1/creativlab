# Payroll Module Design

**Date:** 2026-06-23  
**Status:** Approved

---

## Overview

A new `Modules/Payroll/` module that lets the admin manage monthly salaries for team members. Salaries are entered fresh each month. Marking a record as paid triggers an automatic email to the team member. Monthly data is exportable as CSV.

---

## Database

### Table: `payroll_records`

| Column | Type | Constraints |
|---|---|---|
| `id` | bigint unsigned | PK, auto-increment |
| `team_id` | bigint unsigned | FK → teams.id, cascade delete |
| `year` | smallint unsigned | not null |
| `month` | tinyint unsigned (1–12) | not null |
| `base_salary` | decimal(10,2) | not null |
| `bonus` | decimal(10,2) | not null, default 0 |
| `deductions` | decimal(10,2) | not null, default 0 |
| `net_salary` | decimal(10,2) | not null (stored: base + bonus − deductions) |
| `status` | enum('pending','paid') | not null, default 'pending' |
| `paid_at` | timestamp | nullable |
| `notes` | text | nullable |
| `created_at` | timestamp | |
| `updated_at` | timestamp | |

**Unique index:** `(team_id, year, month)` — one record per member per month.

---

## Module Structure

```
Modules/Payroll/
├── App/
│   ├── Http/Controllers/PayrollController.php
│   ├── Models/PayrollRecord.php
│   └── Providers/
│       ├── PayrollServiceProvider.php
│       └── RouteServiceProvider.php
├── Database/
│   └── migrations/
│       └── 2026_06_23_400001_create_payroll_records_table.php
├── resources/views/
│   └── index.blade.php
├── routes/
│   └── web.php
├── config/config.php
├── module.json
└── composer.json
```

Additional files outside module:
- `Modules/EmailSetting/Database/migrations/2026_06_23_400002_seed_payroll_paid_email_template.php`
- `app/Mail/PayrollPaid.php`
- `modules_statuses.json` — add `"Payroll": true`

---

## Controller Actions

| Method | Route | Action |
|---|---|---|
| GET | `/admin/payroll` | `index` — list all team members for selected month |
| POST | `/admin/payroll/save` | `save` — create or update a payroll record |
| POST | `/admin/payroll/{id}/mark-paid` | `markPaid` — set paid, send email |
| GET | `/admin/payroll/export` | `export` — download CSV for selected month |

---

## Index Page (`/admin/payroll?year=YYYY&month=MM`)

- Month/year selector (defaults to current month)
- Four stat cards (dashboard `crancy-ecom-card` style): **Total Members · Paid · Pending · Total Payout**
- Table: one row per team member — Name, Designation, Base Salary, Bonus, Deductions, Net Salary, Status badge, Action buttons
- If no record exists for a member that month → shows dashes with **Set Salary** button
- If record exists → shows figures + **Edit** and **Mark Paid** (disabled when already paid)
- **Export CSV** button in page header
- **Set Salary / Edit** opens a Bootstrap modal with: Base Salary, Bonus, Deductions, Notes; net salary calculated live via JS

---

## Mark as Paid

1. Sets `status = 'paid'`, `paid_at = now()`
2. Loads email template `id = 11` from `email_templates`
3. Replaces placeholders with member data
4. Calls `EmailHelper::mail_setup()` then `Mail::to($team->mail)->send(new PayrollPaid(...))`
5. Errors are caught and logged; the record is still marked paid even if email fails

---

## Email Template (id = 11)

**Name:** Salary Payment Confirmation  
**Subject:** `Salary Paid — {{month_year}}`  
**Placeholders:** `{{name}}`, `{{designation}}`, `{{month_year}}`, `{{base_salary}}`, `{{bonus}}`, `{{deductions}}`, `{{net_salary}}`, `{{paid_date}}`

Seeded via idempotent migration (checks `where('id', 10)->exists()` before insert).

---

## CSV Export

Columns: `#, Name, Designation, Base Salary, Bonus, Deductions, Net Salary, Status, Paid At`  
Filename: `payroll-YYYY-MM.csv`  
Delivered via `StreamedResponse` — no temp file written to disk.

---

## Constraints & Rules

- Uses `ConvertEmptyStringsToNull` safe input pattern (`$request->input('field', 0)` for numerics)
- `net_salary` is always recomputed on save (base + bonus − deductions), never trusted from the form
- No Blade mail views — uses the DB email template system exclusively
- Migration in `Modules/Payroll/Database/migrations/` (never root `database/migrations/`)
- Email template migration in `Modules/EmailSetting/Database/migrations/` (consistent with existing templates)

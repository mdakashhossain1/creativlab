# Payroll Module Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Build a `Modules/Payroll/` module that lets admin set monthly salaries for team members, mark them paid (triggering email), and export monthly data as CSV.

**Architecture:** Standard nwidart/laravel-modules structure cloned from the Attendance module. One controller handles index (view), save (create/update record), markPaid (set paid + send email), and export (CSV stream). All payroll data lives in a single `payroll_records` table with one row per team member per month.

**Tech Stack:** Laravel 10, nwidart/laravel-modules, Bootstrap 5, FontAwesome 6, PHP 8.2, MySQL

## Global Constraints

- Migrations go in `Modules/Payroll/Database/migrations/` — NEVER `database/migrations/`
- Email template seeded via migration in `Modules/EmailSetting/Database/migrations/`
- No Blade mail views — use DB-driven EmailTemplate system exclusively
- `ConvertEmptyStringsToNull` middleware is active: use `$request->input('field', 0.00)` for decimal inputs
- `net_salary` always computed server-side: `base_salary + bonus - deductions` — never trusted from form
- Admin routes use group: `['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth:admin']]`
- Views use `crancy-ecom-card crancy-ecom-card__v2` for stat cards (matches dashboard)
- FA icons in stat cards use the two-span bubble pattern from Attendance index view
- Email template ID = 11 (IDs 1–10 already used)
- Module registered as `"Payroll": true` in `modules_statuses.json`

---

## File Map

| File | Action | Responsibility |
|---|---|---|
| `Modules/Payroll/App/Providers/PayrollServiceProvider.php` | Create | Boots module: migrations, views, config, routes |
| `Modules/Payroll/App/Providers/RouteServiceProvider.php` | Create | Maps web routes |
| `Modules/Payroll/App/Models/PayrollRecord.php` | Create | Eloquent model for `payroll_records` |
| `Modules/Payroll/App/Http/Controllers/PayrollController.php` | Create | index, save, markPaid, export actions |
| `Modules/Payroll/Database/migrations/2026_06_23_400001_create_payroll_records_table.php` | Create | Creates `payroll_records` table |
| `Modules/Payroll/resources/views/index.blade.php` | Create | Full admin UI: stat cards, filter, table, modal |
| `Modules/Payroll/routes/web.php` | Create | Admin route group for payroll |
| `Modules/Payroll/routes/api.php` | Create | Empty API routes file (required by RouteServiceProvider) |
| `Modules/Payroll/config/config.php` | Create | Empty config array |
| `Modules/Payroll/module.json` | Create | Module metadata |
| `Modules/Payroll/composer.json` | Create | Module autoload |
| `Modules/EmailSetting/Database/migrations/2026_06_23_400002_seed_payroll_paid_email_template.php` | Create | Inserts email template id=11 |
| `app/Mail/PayrollPaid.php` | Create | Mailable — takes rendered HTML + subject |
| `modules_statuses.json` | Modify | Add `"Payroll": true` |

---

## Task 1: Module Scaffold

**Files:**
- Create: `Modules/Payroll/App/Providers/PayrollServiceProvider.php`
- Create: `Modules/Payroll/App/Providers/RouteServiceProvider.php`
- Create: `Modules/Payroll/config/config.php`
- Create: `Modules/Payroll/module.json`
- Create: `Modules/Payroll/composer.json`
- Create: `Modules/Payroll/routes/api.php`
- Modify: `modules_statuses.json`

**Interfaces:**
- Produces: module boots when Laravel starts — `payroll::` view namespace resolves, `admin.payroll.*` route names exist

- [ ] **Step 1: Create directory structure**

```
Modules/Payroll/App/Providers/
Modules/Payroll/App/Http/Controllers/
Modules/Payroll/App/Models/
Modules/Payroll/Database/migrations/
Modules/Payroll/resources/views/
Modules/Payroll/routes/
Modules/Payroll/config/
```

Run in project root (`C:\xampp_8.2\htdocs\creativlab\landing-new`):
```powershell
New-Item -ItemType Directory -Force "Modules/Payroll/App/Providers"
New-Item -ItemType Directory -Force "Modules/Payroll/App/Http/Controllers"
New-Item -ItemType Directory -Force "Modules/Payroll/App/Models"
New-Item -ItemType Directory -Force "Modules/Payroll/Database/migrations"
New-Item -ItemType Directory -Force "Modules/Payroll/resources/views"
New-Item -ItemType Directory -Force "Modules/Payroll/routes"
New-Item -ItemType Directory -Force "Modules/Payroll/config"
```

- [ ] **Step 2: Create `PayrollServiceProvider.php`**

`Modules/Payroll/App/Providers/PayrollServiceProvider.php`:
```php
<?php

namespace Modules\Payroll\App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class PayrollServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'Payroll';
    protected string $moduleNameLower = 'payroll';

    public function boot(): void
    {
        $this->registerCommands();
        $this->registerCommandSchedules();
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/migrations'));
    }

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);
    }

    protected function registerCommands(): void {}
    protected function registerCommandSchedules(): void {}

    public function registerTranslations(): void
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);
        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
            $this->loadJsonTranslationsFrom($langPath);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'lang'), $this->moduleNameLower);
            $this->loadJsonTranslationsFrom(module_path($this->moduleName, 'lang'));
        }
    }

    protected function registerConfig(): void
    {
        $this->publishes([module_path($this->moduleName, 'config/config.php') => config_path($this->moduleNameLower . '.php')], 'config');
        $this->mergeConfigFrom(module_path($this->moduleName, 'config/config.php'), $this->moduleNameLower);
    }

    public function registerViews(): void
    {
        $viewPath   = resource_path('views/modules/' . $this->moduleNameLower);
        $sourcePath = module_path($this->moduleName, 'resources/views');

        $this->publishes([$sourcePath => $viewPath], ['views', $this->moduleNameLower . '-module-views']);
        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);

        $componentNamespace = str_replace('/', '\\', config('modules.namespace') . '\\' . $this->moduleName . '\\' . config('modules.paths.generator.component-class.path'));
        Blade::componentNamespace($componentNamespace, $this->moduleNameLower);
    }

    public function provides(): array { return []; }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (config('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths;
    }
}
```

- [ ] **Step 3: Create `RouteServiceProvider.php`**

`Modules/Payroll/App/Providers/RouteServiceProvider.php`:
```php
<?php

namespace Modules\Payroll\App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    protected string $moduleNamespace = 'Modules\Payroll\App\Http\Controllers';

    public function boot(): void { parent::boot(); }

    public function map(): void
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();
    }

    protected function mapWebRoutes(): void
    {
        Route::middleware('web')
            ->namespace($this->moduleNamespace)
            ->group(module_path('Payroll', '/routes/web.php'));
    }

    protected function mapApiRoutes(): void
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->moduleNamespace)
            ->group(module_path('Payroll', '/routes/api.php'));
    }
}
```

- [ ] **Step 4: Create supporting scaffold files**

`Modules/Payroll/config/config.php`:
```php
<?php
return [];
```

`Modules/Payroll/routes/api.php`:
```php
<?php
```

`Modules/Payroll/module.json`:
```json
{
    "name": "Payroll",
    "alias": "payroll",
    "description": "Monthly payroll management for team members",
    "keywords": [],
    "priority": 0,
    "providers": [
        "Modules\\Payroll\\App\\Providers\\PayrollServiceProvider"
    ],
    "files": []
}
```

`Modules/Payroll/composer.json`:
```json
{
    "name": "nwidart/payroll",
    "description": "",
    "authors": [
        {
            "name": "Nicolas Widart",
            "email": "n.widart@gmail.com"
        }
    ],
    "extra": {
        "laravel": {
            "providers": [],
            "aliases": {}
        }
    },
    "autoload": {
        "psr-4": {
            "Modules\\Payroll\\": "",
            "Modules\\Payroll\\App\\": "app/",
            "Modules\\Payroll\\Database\\Factories\\": "database/factories/",
            "Modules\\Payroll\\Database\\Seeders\\": "database/seeders/"
        }
    },
    "autoload-dev": {
        "psr-4": {
            "Modules\\Payroll\\Tests\\": "tests/"
        }
    }
}
```

- [ ] **Step 5: Register module in `modules_statuses.json`**

Add `"Payroll": true` as the last entry:
```json
{
    ...existing entries...,
    "Attendance": true,
    "Payroll": true
}
```

- [ ] **Step 6: Verify module boots**

```powershell
php artisan module:list
```
Expected: `Payroll` appears in the list with status `Enabled`.

- [ ] **Step 7: Commit**

```powershell
git add Modules/Payroll modules_statuses.json
git commit -m "feat: scaffold Payroll module structure"
```

---

## Task 2: Migration + Model

**Files:**
- Create: `Modules/Payroll/Database/migrations/2026_06_23_400001_create_payroll_records_table.php`
- Create: `Modules/Payroll/App/Models/PayrollRecord.php`

**Interfaces:**
- Produces: `PayrollRecord` model with fillable fields, `team()` belongsTo, `scopeForMonth(Builder, int $year, int $month)`

- [ ] **Step 1: Create migration**

`Modules/Payroll/Database/migrations/2026_06_23_400001_create_payroll_records_table.php`:
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payroll_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('team_id');
            $table->smallInteger('year')->unsigned();
            $table->tinyInteger('month')->unsigned();
            $table->decimal('base_salary', 10, 2);
            $table->decimal('bonus', 10, 2)->default(0);
            $table->decimal('deductions', 10, 2)->default(0);
            $table->decimal('net_salary', 10, 2);
            $table->enum('status', ['pending', 'paid'])->default('pending');
            $table->timestamp('paid_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
            $table->unique(['team_id', 'year', 'month']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payroll_records');
    }
};
```

- [ ] **Step 2: Run migration**

```powershell
php artisan migrate
```
Expected: `Migrated: Modules\Payroll\Database\migrations\2026_06_23_400001_create_payroll_records_table`

- [ ] **Step 3: Create `PayrollRecord` model**

`Modules/Payroll/App/Models/PayrollRecord.php`:
```php
<?php

namespace Modules\Payroll\App\Models;

use App\Models\Team;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class PayrollRecord extends Model
{
    protected $fillable = [
        'team_id', 'year', 'month',
        'base_salary', 'bonus', 'deductions', 'net_salary',
        'status', 'paid_at', 'notes',
    ];

    protected $casts = [
        'paid_at'     => 'datetime',
        'base_salary' => 'decimal:2',
        'bonus'       => 'decimal:2',
        'deductions'  => 'decimal:2',
        'net_salary'  => 'decimal:2',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function scopeForMonth(Builder $query, int $year, int $month): Builder
    {
        return $query->where('year', $year)->where('month', $month);
    }

    public static function computeNet(float $base, float $bonus, float $deductions): float
    {
        return round($base + $bonus - $deductions, 2);
    }
}
```

- [ ] **Step 4: Verify model**

```powershell
php artisan tinker --execute="echo Modules\Payroll\App\Models\PayrollRecord::count();"
```
Expected: `0`

- [ ] **Step 5: Commit**

```powershell
git add Modules/Payroll/Database Modules/Payroll/App/Models
git commit -m "feat(payroll): add payroll_records migration and PayrollRecord model"
```

---

## Task 3: Routes + Controller Skeleton

**Files:**
- Create: `Modules/Payroll/routes/web.php`
- Create: `Modules/Payroll/App/Http/Controllers/PayrollController.php`

**Interfaces:**
- Produces: `admin.payroll.index`, `admin.payroll.save`, `admin.payroll.mark-paid`, `admin.payroll.export` named routes

- [ ] **Step 1: Create routes**

`Modules/Payroll/routes/web.php`:
```php
<?php

use Illuminate\Support\Facades\Route;
use Modules\Payroll\App\Http\Controllers\PayrollController;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth:admin']], function () {

    Route::prefix('payroll')->name('payroll.')->group(function () {
        Route::get('/',              [PayrollController::class, 'index'])->name('index');
        Route::post('/save',         [PayrollController::class, 'save'])->name('save');
        Route::post('/{id}/mark-paid', [PayrollController::class, 'markPaid'])->name('mark-paid');
        Route::get('/export',        [PayrollController::class, 'export'])->name('export');
    });

});
```

- [ ] **Step 2: Create controller**

`Modules/Payroll/App/Http/Controllers/PayrollController.php`:
```php
<?php

namespace Modules\Payroll\App\Http\Controllers;

use App\Helper\EmailHelper;
use App\Mail\PayrollPaid;
use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Modules\EmailSetting\App\Models\EmailTemplate;
use Modules\Payroll\App\Models\PayrollRecord;

class PayrollController extends Controller
{
    public function index(Request $request)
    {
        $year  = (int) $request->input('year',  now()->year);
        $month = (int) $request->input('month', now()->month);

        $teams   = Team::latest()->get();
        $records = PayrollRecord::forMonth($year, $month)
                                ->get()
                                ->keyBy('team_id');

        return view('payroll::index', compact('teams', 'records', 'year', 'month'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'team_id'      => 'required|exists:teams,id',
            'year'         => 'required|integer|min:2020|max:2100',
            'month'        => 'required|integer|min:1|max:12',
            'base_salary'  => 'required|numeric|min:0',
            'bonus'        => 'nullable|numeric|min:0',
            'deductions'   => 'nullable|numeric|min:0',
            'notes'        => 'nullable|string|max:500',
        ]);

        $base       = (float) $request->input('base_salary', 0);
        $bonus      = (float) $request->input('bonus', 0);
        $deductions = (float) $request->input('deductions', 0);

        PayrollRecord::updateOrCreate(
            [
                'team_id' => $request->team_id,
                'year'    => $request->year,
                'month'   => $request->month,
            ],
            [
                'base_salary'  => $base,
                'bonus'        => $bonus,
                'deductions'   => $deductions,
                'net_salary'   => PayrollRecord::computeNet($base, $bonus, $deductions),
                'notes'        => $request->input('notes'),
            ]
        );

        $notification = ['messege' => 'Payroll record saved successfully.', 'alert-type' => 'success'];
        return redirect()->route('admin.payroll.index', ['year' => $request->year, 'month' => $request->month])
                         ->with($notification);
    }

    public function markPaid(Request $request, $id)
    {
        $record = PayrollRecord::findOrFail($id);

        if ($record->status === 'paid') {
            return redirect()->back()->with(['messege' => 'Already marked as paid.', 'alert-type' => 'info']);
        }

        $record->update([
            'status'  => 'paid',
            'paid_at' => now(),
        ]);

        // Send email
        try {
            $team     = $record->team;
            $template = EmailTemplate::find(11);

            if ($template && $team?->mail) {
                $monthLabel = Carbon::createFromDate($record->year, $record->month, 1)->format('F Y');
                $subject    = str_replace('{{month_year}}', $monthLabel, $template->subject);
                $message    = $template->description;
                $message    = str_replace('{{name}}',        $team->translate?->name ?? $team->mail,    $message);
                $message    = str_replace('{{designation}}', $team->translate?->designation ?? '—',     $message);
                $message    = str_replace('{{month_year}}',  $monthLabel,                               $message);
                $message    = str_replace('{{base_salary}}', number_format($record->base_salary, 2),    $message);
                $message    = str_replace('{{bonus}}',       number_format($record->bonus, 2),          $message);
                $message    = str_replace('{{deductions}}',  number_format($record->deductions, 2),     $message);
                $message    = str_replace('{{net_salary}}',  number_format($record->net_salary, 2),     $message);
                $message    = str_replace('{{paid_date}}',   $record->paid_at->format('d M Y'),         $message);

                EmailHelper::mail_setup();
                Mail::to($team->mail)->send(new PayrollPaid($message, $subject));
            }
        } catch (\Exception $e) {
            Log::error('Payroll mark-paid email error: ' . $e->getMessage());
        }

        $notification = ['messege' => 'Marked as paid. Email sent to team member.', 'alert-type' => 'success'];
        return redirect()->route('admin.payroll.index', ['year' => $record->year, 'month' => $record->month])
                         ->with($notification);
    }

    public function export(Request $request)
    {
        $year  = (int) $request->input('year',  now()->year);
        $month = (int) $request->input('month', now()->month);

        $records = PayrollRecord::with('team')
                                ->forMonth($year, $month)
                                ->get();

        $filename = 'payroll-' . $year . '-' . str_pad($month, 2, '0', STR_PAD_LEFT) . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($records) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['#', 'Name', 'Designation', 'Base Salary', 'Bonus', 'Deductions', 'Net Salary', 'Status', 'Paid At']);

            foreach ($records as $i => $rec) {
                fputcsv($handle, [
                    $i + 1,
                    $rec->team?->translate?->name ?? '—',
                    $rec->team?->translate?->designation ?? '—',
                    number_format($rec->base_salary, 2),
                    number_format($rec->bonus, 2),
                    number_format($rec->deductions, 2),
                    number_format($rec->net_salary, 2),
                    ucfirst($rec->status),
                    $rec->paid_at ? $rec->paid_at->format('d M Y') : '—',
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}
```

- [ ] **Step 3: Verify routes are registered**

```powershell
php artisan route:list --name=payroll
```
Expected output includes:
```
admin.payroll.index    GET    admin/payroll
admin.payroll.save     POST   admin/payroll/save
admin.payroll.mark-paid POST  admin/payroll/{id}/mark-paid
admin.payroll.export   GET    admin/payroll/export
```

- [ ] **Step 4: Commit**

```powershell
git add Modules/Payroll/routes Modules/Payroll/App/Http
git commit -m "feat(payroll): add routes and controller with all actions"
```

---

## Task 4: Email Template + PayrollPaid Mailable

**Files:**
- Create: `Modules/EmailSetting/Database/migrations/2026_06_23_400002_seed_payroll_paid_email_template.php`
- Create: `app/Mail/PayrollPaid.php`

**Interfaces:**
- Produces: `PayrollPaid(string $mail_message, string $mail_subject)` Mailable, email template row id=11 in `email_templates` table

- [ ] **Step 1: Create email template migration**

`Modules/EmailSetting/Database/migrations/2026_06_23_400002_seed_payroll_paid_email_template.php`:
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::table('email_templates')->where('id', 11)->exists()) {
            return;
        }

        DB::table('email_templates')->insert([
            'id'          => 11,
            'name'        => 'Salary Payment Confirmation',
            'subject'     => 'Salary Paid — {{month_year}}',
            'description' => '<p>Dear <strong>{{name}}</strong>,</p>
<p>We are pleased to inform you that your salary for <strong>{{month_year}}</strong> has been processed and paid.</p>
<table style="width:100%;border-collapse:collapse;margin:16px 0;">
  <tr style="border-bottom:1px solid #eee;">
    <td style="padding:8px 0;color:#666;width:50%;">Designation</td>
    <td style="padding:8px 0;font-weight:600;text-align:right;">{{designation}}</td>
  </tr>
  <tr style="border-bottom:1px solid #eee;">
    <td style="padding:8px 0;color:#666;">Base Salary</td>
    <td style="padding:8px 0;font-weight:600;text-align:right;">{{base_salary}}</td>
  </tr>
  <tr style="border-bottom:1px solid #eee;">
    <td style="padding:8px 0;color:#666;">Bonus</td>
    <td style="padding:8px 0;font-weight:600;text-align:right;">{{bonus}}</td>
  </tr>
  <tr style="border-bottom:1px solid #eee;">
    <td style="padding:8px 0;color:#666;">Deductions</td>
    <td style="padding:8px 0;font-weight:600;text-align:right;">{{deductions}}</td>
  </tr>
  <tr>
    <td style="padding:8px 0;color:#333;font-weight:700;">Net Salary</td>
    <td style="padding:8px 0;font-weight:700;text-align:right;">{{net_salary}}</td>
  </tr>
</table>
<p><strong>Date Paid:</strong> {{paid_date}}</p>
<p>If you have any questions about this payment, please contact the admin.</p>
<p>Best regards,<br>CreativLab Team</p>',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        DB::table('email_templates')->where('id', 11)->delete();
    }
};
```

- [ ] **Step 2: Run migration to seed template**

```powershell
php artisan migrate
```
Expected: `Migrated: Modules\EmailSetting\Database\migrations\2026_06_23_400002_seed_payroll_paid_email_template`

- [ ] **Step 3: Create `PayrollPaid` Mailable**

`app/Mail/PayrollPaid.php`:
```php
<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PayrollPaid extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public string $mail_subject;
    public string $mail_message;

    public function __construct(string $mail_message, string $mail_subject)
    {
        $this->mail_message = $mail_message;
        $this->mail_subject = $mail_subject;
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: $this->mail_subject);
    }

    public function content(): Content
    {
        return new Content(view: 'mail.order_success_mail');
    }

    public function attachments(): array
    {
        return [];
    }
}
```

- [ ] **Step 4: Verify template row exists**

```powershell
php artisan tinker --execute="dd(DB::table('email_templates')->where('id',11)->first());"
```
Expected: object with `name = 'Salary Payment Confirmation'`

- [ ] **Step 5: Commit**

```powershell
git add Modules/EmailSetting/Database/migrations/2026_06_23_400002_seed_payroll_paid_email_template.php app/Mail/PayrollPaid.php
git commit -m "feat(payroll): add payroll paid email template and Mailable"
```

---

## Task 5: Index View

**Files:**
- Create: `Modules/Payroll/resources/views/index.blade.php`

**Interfaces:**
- Consumes: `$teams` (Collection of `App\Models\Team`), `$records` (Collection keyed by `team_id`), `$year` (int), `$month` (int)
- Produces: rendered admin page at `/admin/payroll`

- [ ] **Step 1: Create the view**

`Modules/Payroll/resources/views/index.blade.php`:
```blade
@extends('admin.master_layout')
@section('title')<title>{{ __('Payroll Management') }}</title>@endsection
@section('body-header')
    <h3 class="crancy-header__title m-0">{{ __('Payroll') }}</h3>
    <p class="crancy-header__text">{{ __('Team') }} >> {{ __('Payroll Management') }}</p>
@endsection

@section('body-content')
<section class="crancy-adashboard crancy-show">
    <div class="container container__bscreen">
        <div class="row">
            <div class="col-12">
                <div class="crancy-body">
                    <div class="crancy-dsinner">

                        {{-- Stat Cards --}}
                        @php
                            $totalMembers  = $teams->count();
                            $paidCount     = $records->where('status', 'paid')->count();
                            $pendingCount  = $records->where('status', 'pending')->count();
                            $totalPayout   = $records->sum('net_salary');
                        @endphp
                        <div class="row mg-top-30">
                            @foreach([
                                ['Total Members', $totalMembers, 'fas fa-users'],
                                ['Paid',          $paidCount,    'fas fa-check-circle'],
                                ['Pending',       $pendingCount, 'fas fa-hourglass-half'],
                                ['Total Payout',  number_format($totalPayout, 2), 'fas fa-money-bill-wave'],
                            ] as [$label, $value, $icon])
                            <div class="col-lg-3 col-6 mg-top-30">
                                <div class="crancy-ecom-card crancy-ecom-card__v2">
                                    <div class="flex-main text-theme">
                                        <span style="width:54px;height:54px;border-radius:50%;display:inline-flex;align-items:center;justify-content:center;flex-shrink:0;position:relative;">
                                            <span style="position:absolute;inset:0;border-radius:50%;background:currentColor;opacity:0.08;"></span>
                                            <i class="{{ $icon }}" style="font-size:20px;position:relative;z-index:1;"></i>
                                        </span>
                                        <div class="flex-1">
                                            <div class="crancy-ecom-card__heading">
                                                <div class="crancy-ecom-card__icon">
                                                    <h4 class="crancy-ecom-card__title">{{ __($label) }}</h4>
                                                </div>
                                            </div>
                                            <div class="crancy-ecom-card__content">
                                                <div class="crancy-ecom-card__camount">
                                                    <div class="crancy-ecom-card__camount__inside">
                                                        <h3 class="crancy-ecom-card__amount">{{ $value }}</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        {{-- Month Filter + Export --}}
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mg-top-30">
                            <form method="GET" class="d-flex gap-2 align-items-center flex-wrap">
                                <select name="month" class="form-select" style="width:150px;">
                                    @foreach(range(1,12) as $m)
                                        <option value="{{ $m }}" @selected($m == $month)>
                                            {{ \Carbon\Carbon::createFromDate(null, $m, 1)->format('F') }}
                                        </option>
                                    @endforeach
                                </select>
                                <select name="year" class="form-select" style="width:110px;">
                                    @foreach(range(now()->year - 2, now()->year + 1) as $y)
                                        <option value="{{ $y }}" @selected($y == $year)>{{ $y }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="crancy-btn">{{ __('Filter') }}</button>
                            </form>
                            <a href="{{ route('admin.payroll.export', ['year' => $year, 'month' => $month]) }}"
                               class="crancy-btn">
                                <i class="fas fa-file-csv me-1"></i>{{ __('Export CSV') }}
                            </a>
                        </div>

                        {{-- Payroll Table --}}
                        <div class="crancy-table crancy-table--v3 mg-top-30">
                            <div class="table-responsive">
                                <table class="crancy-table__main crancy-table__main-v3 no-footer w-100">
                                    <thead class="crancy-table__head">
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('Member') }}</th>
                                            <th>{{ __('Base Salary') }}</th>
                                            <th>{{ __('Bonus') }}</th>
                                            <th>{{ __('Deductions') }}</th>
                                            <th>{{ __('Net Salary') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="crancy-table__body">
                                        @foreach($teams as $i => $team)
                                        @php $rec = $records->get($team->id); @endphp
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    @if($team->image)
                                                        <img src="{{ asset($team->image) }}" style="width:36px;height:36px;border-radius:50%;object-fit:cover;">
                                                    @else
                                                        <div style="width:36px;height:36px;border-radius:50%;background:#e9ecef;display:flex;align-items:center;justify-content:center;">
                                                            <i class="fas fa-user text-muted"></i>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <div class="fw-semibold">{{ $team->translate?->name }}</div>
                                                        <small class="text-muted">{{ $team->translate?->designation }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $rec ? number_format($rec->base_salary, 2) : '—' }}</td>
                                            <td>{{ $rec ? number_format($rec->bonus, 2) : '—' }}</td>
                                            <td>{{ $rec ? number_format($rec->deductions, 2) : '—' }}</td>
                                            <td>{{ $rec ? number_format($rec->net_salary, 2) : '—' }}</td>
                                            <td>
                                                @if(!$rec)
                                                    <span class="badge bg-secondary">{{ __('Not Set') }}</span>
                                                @elseif($rec->status === 'paid')
                                                    <span class="badge bg-success">{{ __('Paid') }}</span>
                                                @else
                                                    <span class="badge bg-warning text-dark">{{ __('Pending') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary me-1"
                                                    onclick="openSalaryModal(
                                                        {{ $team->id }},
                                                        '{{ addslashes($team->translate?->name) }}',
                                                        {{ $year }}, {{ $month }},
                                                        {{ $rec ? $rec->id : 'null' }},
                                                        {{ $rec ? $rec->base_salary : 0 }},
                                                        {{ $rec ? $rec->bonus : 0 }},
                                                        {{ $rec ? $rec->deductions : 0 }},
                                                        '{{ addslashes($rec?->notes ?? '') }}'
                                                    )">
                                                    <i class="fas fa-{{ $rec ? 'edit' : 'plus' }}"></i>
                                                    {{ $rec ? __('Edit') : __('Set Salary') }}
                                                </button>
                                                @if($rec && $rec->status === 'pending')
                                                <form method="POST"
                                                      action="{{ route('admin.payroll.mark-paid', $rec->id) }}"
                                                      style="display:inline;"
                                                      onsubmit="return confirm('Mark this member as paid and send email?')">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success">
                                                        <i class="fas fa-check me-1"></i>{{ __('Mark Paid') }}
                                                    </button>
                                                </form>
                                                @elseif($rec && $rec->status === 'paid')
                                                    <small class="text-muted ms-1">
                                                        {{ __('Paid') }} {{ $rec->paid_at?->format('d M Y') }}
                                                    </small>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Set / Edit Salary Modal --}}
<div class="modal fade" id="salaryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="salaryModalLabel">{{ __('Set Salary') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"><i class="fas fa-times"></i></button>
            </div>
            <form method="POST" action="{{ route('admin.payroll.save') }}">
                @csrf
                <input type="hidden" name="team_id" id="s_team_id">
                <input type="hidden" name="year"    id="s_year">
                <input type="hidden" name="month"   id="s_month">
                <div class="modal-body">
                    <p class="mb-3 fw-semibold" id="s_member_name"></p>
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">{{ __('Base Salary') }} <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" min="0" name="base_salary" id="s_base"
                                   class="form-control" required oninput="calcNet()">
                        </div>
                        <div class="col-6">
                            <label class="form-label">{{ __('Bonus') }}</label>
                            <input type="number" step="0.01" min="0" name="bonus" id="s_bonus"
                                   class="form-control" value="0" oninput="calcNet()">
                        </div>
                        <div class="col-6">
                            <label class="form-label">{{ __('Deductions') }}</label>
                            <input type="number" step="0.01" min="0" name="deductions" id="s_deductions"
                                   class="form-control" value="0" oninput="calcNet()">
                        </div>
                        <div class="col-12">
                            <label class="form-label">{{ __('Net Salary') }}</label>
                            <div class="form-control bg-light fw-bold" id="s_net">0.00</div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">{{ __('Notes') }}</label>
                            <textarea name="notes" id="s_notes" class="form-control" rows="2"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="display:flex;justify-content:space-between;gap:10px;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js_section')
<script>
"use strict";

function openSalaryModal(teamId, name, year, month, recId, base, bonus, deductions, notes) {
    document.getElementById('s_team_id').value    = teamId;
    document.getElementById('s_year').value       = year;
    document.getElementById('s_month').value      = month;
    document.getElementById('s_member_name').textContent = name;
    document.getElementById('s_base').value       = base || '';
    document.getElementById('s_bonus').value      = bonus || 0;
    document.getElementById('s_deductions').value = deductions || 0;
    document.getElementById('s_notes').value      = notes || '';
    calcNet();
    new bootstrap.Modal(document.getElementById('salaryModal')).show();
}

function calcNet() {
    const base       = parseFloat(document.getElementById('s_base').value) || 0;
    const bonus      = parseFloat(document.getElementById('s_bonus').value) || 0;
    const deductions = parseFloat(document.getElementById('s_deductions').value) || 0;
    document.getElementById('s_net').textContent = (base + bonus - deductions).toFixed(2);
}
</script>
@endpush
```

- [ ] **Step 2: Verify page loads**

Visit `http://localhost/creativlab/landing-new/public/admin/payroll` (log in as admin first).
Expected: Page loads with stat cards showing zeros, table showing all team members with "Not Set" badges.

- [ ] **Step 3: Commit**

```powershell
git add Modules/Payroll/resources/views/index.blade.php
git commit -m "feat(payroll): add payroll index view with stat cards, table, and salary modal"
```

---

## Task 6: Wire Admin Sidebar Link

**Files:**
- Modify: `resources/views/admin/partials/sidebar.blade.php` (or equivalent sidebar file — search for `attendance` to find the exact file)

**Interfaces:**
- Produces: "Payroll" link visible in admin sidebar under Team section

- [ ] **Step 1: Find the sidebar file**

```powershell
Get-ChildItem "resources/views/admin" -Recurse -Filter "*.blade.php" | Select-String -Pattern "attendance" | Select-Object Path | Get-Unique
```

- [ ] **Step 2: Add Payroll link next to Attendance**

Find the block that contains the Attendance sidebar link. It will look something like:
```blade
<a href="{{ route('admin.attendance.index') }}">...</a>
```

Add immediately after it:
```blade
<li class="crancy-sidebar__list-item">
    <a href="{{ route('admin.payroll.index') }}" class="{{ request()->routeIs('admin.payroll.*') ? 'active' : '' }}">
        <i class="fas fa-money-bill-wave"></i>
        <span>{{ __('Payroll') }}</span>
    </a>
</li>
```

- [ ] **Step 3: Verify sidebar link appears**

Refresh the admin panel. Expected: "Payroll" appears in the sidebar under Team/Attendance. Clicking it navigates to `/admin/payroll`.

- [ ] **Step 4: Commit**

```powershell
git add resources/views/admin
git commit -m "feat(payroll): add Payroll link to admin sidebar"
```

---

## Task 7: End-to-End Verification + Push

- [ ] **Step 1: Full flow test**

1. Go to `/admin/payroll` — stat cards show 0s, all members show "Not Set"
2. Click **Set Salary** on any member → modal opens with member name shown
3. Enter Base Salary = 50000, Bonus = 5000, Deductions = 2000 → Net shows 53000.00
4. Click Save → redirects back, row shows the figures, status = "Pending"
5. Click **Mark Paid** → confirm dialog → redirects back, status = "Paid", paid date shown
6. Click **Export CSV** → file `payroll-YYYY-MM.csv` downloads with correct columns and data
7. Change month in filter → member shows "Not Set" for that month (fresh each month confirmed)

- [ ] **Step 2: Verify email template is editable**

Go to Admin → Email Settings → Templates. Template "Salary Payment Confirmation" should appear in the list and be editable.

- [ ] **Step 3: Final commit and push**

```powershell
git add -A
git commit -m "feat(payroll): complete payroll module — salary management, mark paid, email, CSV export"
git push origin main
```

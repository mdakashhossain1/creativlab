<?php

use Illuminate\Support\Facades\Route;
use Modules\ArknoxMonitor\App\Http\Controllers\MonitorController;

Route::prefix(config('arknoxmonitor.route_prefix', 'arknox-monitor'))
    ->middleware('api')
    ->group(function () {

        // Health
        Route::get('health',              [MonitorController::class, 'health']);

        // Usage
        Route::get('usage',               [MonitorController::class, 'usage']);
        Route::get('usage/daily',         [MonitorController::class, 'usageDaily']);

        // Invoices (read)
        Route::get('invoice',             [MonitorController::class, 'invoice']);
        Route::get('invoices',            [MonitorController::class, 'invoices']);

        // Invoices (write)
        Route::post('invoice/generate',   [MonitorController::class, 'generateInvoice']);
        Route::post('invoice/mark-paid',  [MonitorController::class, 'markPaid']);
        Route::post('invoice/mark-unpaid',[MonitorController::class, 'markUnpaid']);
    });

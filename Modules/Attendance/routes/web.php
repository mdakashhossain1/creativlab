<?php

use Illuminate\Support\Facades\Route;
use Modules\Attendance\App\Http\Controllers\AttendanceController;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth:admin']], function () {

    Route::prefix('attendance')->name('attendance.')->group(function () {
        Route::get('/',                        [AttendanceController::class, 'index'])->name('index');
        Route::get('/calendar/{team_id}',      [AttendanceController::class, 'calendar'])->name('calendar');
        Route::get('/monthly',                 [AttendanceController::class, 'monthly'])->name('monthly');
        Route::get('/export',                  [AttendanceController::class, 'export'])->name('export');
        Route::post('/manual-entry',           [AttendanceController::class, 'manualEntry'])->name('manual-entry');
        Route::get('/devices',                 [AttendanceController::class, 'devices'])->name('devices');
        Route::post('/devices/{id}/toggle',    [AttendanceController::class, 'toggleDevice'])->name('devices.toggle');
        Route::delete('/devices/{id}',         [AttendanceController::class, 'deleteDevice'])->name('devices.delete');
        Route::get('/qrcode',                  [AttendanceController::class, 'qrCode'])->name('qrcode');
    });

});

<?php

use Illuminate\Support\Facades\Route;
use Modules\Attendance\App\Http\Controllers\AttendanceApiController;

// Public API — no auth required, apps use device fingerprint as identity
Route::prefix('attendance')->group(function () {
    Route::post('/register-device', [AttendanceApiController::class, 'registerDevice']);
    Route::post('/checkin',         [AttendanceApiController::class, 'checkIn']);
    Route::post('/checkout',        [AttendanceApiController::class, 'checkOut']);
    Route::get('/status/{fingerprint}', [AttendanceApiController::class, 'status']);
    Route::get('/by-date',          [AttendanceApiController::class, 'byDate']);
    Route::post('/admin-edit',      [AttendanceApiController::class, 'adminEdit']);
});

Route::get('/team-members', [AttendanceApiController::class, 'teamMembers']);

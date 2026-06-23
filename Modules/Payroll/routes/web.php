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

<?php

use Illuminate\Support\Facades\Route;
use Modules\Task\App\Http\Controllers\TaskController;

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => ['auth:admin']], function () {

    Route::get('tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::post('tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::put('tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    Route::post('tasks/{id}/toggle-complete', [TaskController::class, 'toggleComplete'])->name('tasks.toggle-complete');
    Route::post('tasks/{id}/move', [TaskController::class, 'move'])->name('tasks.move');
});

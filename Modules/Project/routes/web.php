<?php

use Illuminate\Support\Facades\Route;
use Modules\Project\App\Http\Controllers\ProjectController;
use Modules\Project\App\Http\Controllers\PortfolioCategoryController;

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => ['auth:admin']], function () {

    // Portfolio Categories
    Route::get('portfolio-category',         [PortfolioCategoryController::class, 'index'])->name('portfolio-category.index');
    Route::post('portfolio-category',        [PortfolioCategoryController::class, 'store'])->name('portfolio-category.store');
    Route::put('portfolio-category/{id}',    [PortfolioCategoryController::class, 'update'])->name('portfolio-category.update');
    Route::delete('portfolio-category/{id}', [PortfolioCategoryController::class, 'destroy'])->name('portfolio-category.destroy');

    // Projects
    Route::resource('project', ProjectController::class)->names('project');

    // Portfolio Items within a project
    Route::get('project-items/{project_id}',     [ProjectController::class, 'portfolioItems'])->name('project-items');
    Route::post('project-items/{project_id}',    [ProjectController::class, 'storePortfolioItem'])->name('project-items.store');
    Route::delete('project-item/{id}',           [ProjectController::class, 'deletePortfolioItem'])->name('project-item.delete');

    // Project Gallery
    Route::get('project-gallery/{id}',           [ProjectController::class, 'listing_project'])->name('project-gallery');
    Route::post('upload-gallery/{id}',           [ProjectController::class, 'upload_listing_project'])->name('upload-project');
    Route::delete('delete-project-gallery/{id}', [ProjectController::class, 'delete_listing_project'])->name('delete-project');
});

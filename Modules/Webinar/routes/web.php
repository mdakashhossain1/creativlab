<?php

use Illuminate\Support\Facades\Route;

// ─── Admin routes ────────────────────────────────────────────────────────────
Route::middleware(['web', 'auth:admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('webinar', 'Admin\WebinarController@index')->name('webinar.index');
    Route::get('webinar/create', 'Admin\WebinarController@create')->name('webinar.create');
    Route::post('webinar', 'Admin\WebinarController@store')->name('webinar.store');

    // registration sub-routes BEFORE the {webinar} wildcard to avoid conflict
    Route::delete('webinar/registration/{registration}', 'Admin\WebinarController@deleteRegistration')->name('webinar.registration.delete');
    Route::patch('webinar/registration/{registration}/approve', 'Admin\WebinarController@approveRegistration')->name('webinar.registration.approve');

    Route::get('webinar/{webinar}/edit', 'Admin\WebinarController@edit')->name('webinar.edit');
    Route::put('webinar/{webinar}', 'Admin\WebinarController@update')->name('webinar.update');
    Route::delete('webinar/{webinar}', 'Admin\WebinarController@destroy')->name('webinar.destroy');

    Route::get('webinar/{webinar}/builder', 'Admin\WebinarController@builder')->name('webinar.builder');
    Route::post('webinar/{webinar}/save-page', 'Admin\WebinarController@savePage')->name('webinar.save-page');

    Route::get('webinar/{webinar}/registrations', 'Admin\WebinarController@registrations')->name('webinar.registrations');
    Route::get('webinar/{webinar}/registrations-json', 'Admin\WebinarController@registrationsJson')->name('webinar.registrations-json');
});

// ─── Frontend routes ──────────────────────────────────────────────────────────
Route::middleware(['web'])->group(function () {

    Route::get('webinar/{slug}', 'Frontend\WebinarFrontendController@show')->name('webinar.show');
    Route::post('webinar/{slug}/register', 'Frontend\WebinarFrontendController@register')->name('webinar.register');
    Route::get('webinar/{slug}/checkout', 'Frontend\WebinarFrontendController@checkout')->name('webinar.checkout');
    Route::post('webinar/{slug}/pay/stripe', 'Frontend\WebinarFrontendController@stripePayment')->name('webinar.pay.stripe');
    Route::post('webinar/{slug}/pay/bank', 'Frontend\WebinarFrontendController@bankPayment')->name('webinar.pay.bank');
    Route::post('webinar/{slug}/pay/razorpay', 'Frontend\WebinarFrontendController@razorpayPayment')->name('webinar.pay.razorpay');
});

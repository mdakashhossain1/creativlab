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
});

// ─── Temporary diagnostic route (remove after CSS bug is confirmed fixed) ────
Route::middleware(['web', 'auth:admin'])->get('webinar-debug/{slug}', function ($slug) {
    $w = \Modules\Webinar\App\Models\Webinar::where('slug', $slug)->firstOrFail();
    $html = $w->page_html ?? '';
    $css  = $w->page_css  ?? '';

    preg_match_all('/#([a-z0-9]+)\s*\{/', $html, $htmlIds);   // IDs found inside embedded <style>
    preg_match_all('/\sid="([^"]+)"/', $html, $elemIds);       // id="" on elements
    preg_match_all('/#([a-z0-9]+)\s*\{/', $css, $cssIds);     // IDs in page_css column

    $overlap = array_intersect($elemIds[1], $cssIds[1]);

    return response()->json([
        'page_html_length'     => strlen($html),
        'page_css_length'      => strlen($css),
        'page_html_first_200'  => substr($html, 0, 200),
        'page_css_first_200'   => substr($css, 0, 200),
        'html_has_style_tag'   => strpos($html, '<style') !== false,
        'html_has_body_wrapper'=> (bool) preg_match('/^<body/i', ltrim($html)),
        'element_ids_in_html'  => array_slice($elemIds[1], 0, 10),
        'ids_in_page_css_col'  => array_slice($cssIds[1], 0, 10),
        'matching_ids'         => array_values($overlap),
        'match_count'          => count($overlap),
        'css_col_id_count'     => count($cssIds[1]),
        'verdict'              => count($cssIds[1]) > 0 && count($overlap) === count($cssIds[1])
                                    ? 'PASS — all CSS IDs match HTML element IDs'
                                    : (count($overlap) > 0
                                        ? 'PARTIAL — only '.count($overlap).' of '.count($cssIds[1]).' CSS IDs match'
                                        : 'FAIL — no CSS IDs match HTML element IDs'),
    ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
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

<?php

namespace Modules\Webinar\App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\Webinar\App\Models\Webinar;
use Modules\Webinar\App\Models\WebinarRegistration;

class WebinarController extends Controller
{
    public function index()
    {
        $webinars = Webinar::latest()->get();
        return view('webinar::admin.index', compact('webinars'));
    }

    public function create()
    {
        return view('webinar::admin.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug'  => 'nullable|string|max:255|unique:webinars,slug',
        ]);

        $slug = $request->input('slug')
            ? Str::slug($request->input('slug'))
            : Str::slug($request->input('title'));

        $webinar = Webinar::create([
            'title'            => $request->input('title'),
            'slug'             => $slug,
            'webinar_date'     => $request->input('webinar_date') ?: null,
            'total_seats'      => $request->input('total_seats', 0),
            'payment_enabled'  => $request->has('payment_enabled') ? 1 : 0,
            'price'            => $request->input('price', 0),
            'currency_symbol'  => $request->input('currency_symbol', '$'),
            'status'           => $request->input('status', 1),
        ]);

        return redirect()->route('admin.webinar.builder', $webinar->id)
            ->with(['message' => 'Webinar created. Now build your page!', 'alert-type' => 'success']);
    }

    public function edit(Webinar $webinar)
    {
        return view('webinar::admin.form', compact('webinar'));
    }

    public function update(Request $request, Webinar $webinar)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug'  => 'nullable|string|max:255|unique:webinars,slug,' . $webinar->id,
        ]);

        $slug = $request->input('slug')
            ? Str::slug($request->input('slug'))
            : Str::slug($request->input('title'));

        $webinar->update([
            'title'           => $request->input('title'),
            'slug'            => $slug,
            'webinar_date'    => $request->input('webinar_date') ?: null,
            'total_seats'     => $request->input('total_seats', 0),
            'payment_enabled' => $request->has('payment_enabled') ? 1 : 0,
            'price'           => $request->input('price', 0),
            'currency_symbol' => $request->input('currency_symbol', '$'),
            'status'          => $request->input('status', 1),
        ]);

        return redirect()->route('admin.webinar.index')
            ->with(['message' => 'Webinar updated successfully.', 'alert-type' => 'success']);
    }

    public function destroy(Webinar $webinar)
    {
        $webinar->delete();
        return redirect()->route('admin.webinar.index')
            ->with(['message' => 'Webinar deleted.', 'alert-type' => 'success']);
    }

    public function builder(Webinar $webinar)
    {
        return view('webinar::admin.builder', compact('webinar'));
    }

    public function savePage(Request $request, Webinar $webinar)
    {
        // Save html and css first — these are critical for the frontend to render.
        $webinar->update([
            'page_html' => $request->input('html', ''),
            'page_css'  => $request->input('css', ''),
        ]);

        // page_data is for builder state reload only. Save separately so a missing
        // column (migration not yet run on this environment) never blocks the html/css save.
        try {
            $webinar->update(['page_data' => $request->input('data', '')]);
        } catch (\Exception $e) {
            // column not yet migrated — not fatal
        }

        return response()->json(['success' => true, 'message' => 'Page saved successfully!']);
    }

    public function registrations(Webinar $webinar)
    {
        $registrations = $webinar->registrations()->latest()->get();
        return view('webinar::admin.registrations', compact('webinar', 'registrations'));
    }

    public function deleteRegistration(WebinarRegistration $registration)
    {
        $webinar = $registration->webinar;
        $registration->delete();
        return redirect()->route('admin.webinar.registrations', $webinar->id)
            ->with(['message' => 'Registration deleted.', 'alert-type' => 'success']);
    }

    public function approveRegistration(WebinarRegistration $registration)
    {
        $registration->update(['payment_status' => 'approved']);
        return redirect()->back()->with(['message' => 'Registration approved.', 'alert-type' => 'success']);
    }
}

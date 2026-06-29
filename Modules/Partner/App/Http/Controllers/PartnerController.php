<?php

namespace Modules\Partner\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\UploadManager;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Partner\App\Models\Partner;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::all();
        return view('partner::index', compact('partners'));
    }

    public function create()
    {
        return view('partner::create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate(
            ['logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'],
            ['logo.required' => trans('Logo is required')]
        );

        $partner = new Partner();

        if ($request->logo) {
            $partner->logo = app(UploadManager::class)->upload(
                $request->logo, 'uploads/custom-images', ['prefix' => 'partner']
            );
        }

        $partner->link = $request->link;
        $partner->save();

        $notification = array('message' => trans('Created Successfully'), 'alert-type' => 'success');
        return redirect()->route('admin.partner.index')->with($notification);
    }

    public function edit($id)
    {
        $partner = Partner::findOrFail($id);
        return view('partner::edit', compact('partner'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $partner = Partner::findOrFail($id);

        if ($request->logo) {
            $old_logo = $partner->logo;
            $partner->logo = app(UploadManager::class)->upload(
                $request->logo, 'uploads/custom-images', ['prefix' => 'partner']
            );
            $partner->save();
            app(UploadManager::class)->delete($old_logo);
        }

        $partner->link = $request->link;
        $partner->save();

        $notification = array('message' => trans('Update Successfully'), 'alert-type' => 'success');
        return redirect()->route('admin.partner.index')->with($notification);
    }

    public function destroy($id): RedirectResponse
    {
        $partner = Partner::findOrFail($id);
        app(UploadManager::class)->delete($partner->logo);
        $partner->delete();

        $notification = array('message' => trans('Delete Successfully'), 'alert-type' => 'success');
        return redirect()->route('admin.partner.index')->with($notification);
    }
}

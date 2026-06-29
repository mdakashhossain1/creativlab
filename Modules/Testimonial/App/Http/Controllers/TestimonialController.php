<?php

namespace Modules\Testimonial\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\UploadManager;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Language\App\Models\Language;
use Modules\Testimonial\App\Http\Requests\TestimonialRequest;
use Modules\Testimonial\App\Models\Testimonial;
use Modules\Testimonial\App\Models\TestimonialTrasnlation;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::with('translate')->latest()->get();
        return view('testimonial::index', ['testimonials' => $testimonials]);
    }

    public function create()
    {
        return view('testimonial::create');
    }

    public function store(TestimonialRequest $request): RedirectResponse
    {
        $testimonial = new Testimonial();

        if ($request->image) {
            $testimonial->image = app(UploadManager::class)->upload(
                $request->image, 'uploads/custom-images', ['prefix' => 'testimonial']
            );
        }

        $testimonial->rating = $request->rating;
        $testimonial->status = $request->status ? 'active' : 'inactive';
        $testimonial->save();

        $languages = Language::all();
        foreach ($languages as $language) {
            $testimonial_trans = new TestimonialTrasnlation();
            $testimonial_trans->lang_code = $language->lang_code;
            $testimonial_trans->testimonial_id = $testimonial->id;
            $testimonial_trans->name = $request->name;
            $testimonial_trans->designation = $request->designation;
            $testimonial_trans->comment = $request->comment;
            $testimonial_trans->save();
        }

        $notify_message = array('message' => trans('Created successfully'), 'alert-type' => 'success');
        return redirect()->route('admin.testimonial.edit', ['testimonial' => $testimonial->id, 'lang_code' => admin_lang()])->with($notify_message);
    }

    public function edit(Request $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $translate = TestimonialTrasnlation::where(['lang_code' => $request->lang_code, 'testimonial_id' => $id])->first();
        return view('testimonial::edit', ['testimonial' => $testimonial, 'translate' => $translate]);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $testimonial = Testimonial::findOrFail($id);

        if ($request->lang_code == admin_lang()) {
            if ($request->image) {
                $existing_file = $testimonial->image;
                $testimonial->image = app(UploadManager::class)->upload(
                    $request->image, 'uploads/custom-images', ['prefix' => 'testimonial']
                );
                $testimonial->save();
                app(UploadManager::class)->delete($existing_file);
            }

            $testimonial->rating = $request->rating;
            $testimonial->status = $request->status ? 'active' : 'inactive';
            $testimonial->save();
        }

        $testimonial_trans = TestimonialTrasnlation::findOrFail($request->translate_id);
        $testimonial_trans->name = $request->name;
        $testimonial_trans->designation = $request->designation;
        $testimonial_trans->comment = $request->comment;
        $testimonial_trans->save();

        $notify_message = array('message' => trans('Updated successfully'), 'alert-type' => 'success');
        return redirect()->back()->with($notify_message);
    }

    public function destroy($id): RedirectResponse
    {
        $testimonial = Testimonial::findOrFail($id);
        app(UploadManager::class)->delete($testimonial->image);
        $testimonial->delete();
        TestimonialTrasnlation::where('testimonial_id', $id)->delete();

        $notify_message = array('message' => trans('Deleted successfully'), 'alert-type' => 'success');
        return redirect()->back()->with($notify_message);
    }

    public function setup_language($lang_code)
    {
        $testimonial_trans = TestimonialTrasnlation::where('lang_code', admin_lang())->get();
        foreach ($testimonial_trans as $testimonial_tran) {
            $new_trans = new TestimonialTrasnlation();
            $new_trans->lang_code = $lang_code;
            $new_trans->name = $testimonial_tran->name;
            $new_trans->designation = $testimonial_tran->designation;
            $new_trans->comment = $testimonial_tran->comment;
            $new_trans->testimonial_id = $testimonial_tran->testimonial_id;
            $new_trans->save();
        }
    }
}

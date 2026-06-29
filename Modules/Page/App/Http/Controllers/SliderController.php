<?php

namespace Modules\Page\App\Http\Controllers;
use Illuminate\Http\Request;
use Modules\Language\App\Models\Language;
use Modules\Page\App\Models\Slider;
use Modules\Page\App\Models\SliderTranslation;
use Illuminate\Routing\Controller;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::with('translate')->latest()->get();
        return view('page::slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('page::slider.create');
    }

    public function store(Request $request, $id = null)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'small_text' => 'required|string|max:255',
            'url' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
        ]);

        $slider = $id ? Slider::findOrFail($id) : new Slider();

        $slider->url = $request->url;

        if ($request->hasFile('image')) {
            $old_image = $id ? $slider->image : null;
            if ($old_image) app(\App\Services\UploadManager::class)->delete($old_image);
            $slider->image = app(\App\Services\UploadManager::class)->upload(
                $request->file('image'), 'uploads/custom-images', ['format' => 'webp', 'quality' => 80, 'prefix' => 'slider']
            );
        }

        $slider->save();

        $languages = Language::all();
        foreach ($languages as $language) {
            $listing_translate = SliderTranslation::firstOrNew([
                'lang_code' => $language->lang_code,
                'slider_id' => $slider->id,
            ]);

            $listing_translate->title = $request->title;
            $listing_translate->small_text = $request->small_text;
            $listing_translate->button_text = $request->button_text;
            $listing_translate->save();
        }

        $notification = trans('' . ($id ? 'Updated Successfully' : 'Created Successfully'));
        $notification = array('messege' => $notification, 'alert-type' => 'success');
        return redirect()->route('admin.slider.index')->with($notification);
    }

    public function edit($id)
    {
        $slider = Slider::findOrFail($id);

        return view('page::slider.create', compact('slider'));
    }

    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        $old_image = $slider->image;

        if ($old_image) app(\App\Services\UploadManager::class)->delete($old_image);

        SliderTranslation::where('slider_id',$id)->delete();


        $slider->delete();

        $notification=  trans('Delete Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.slider.index')->with($notification);
    }


    public function setup_language($lang_code){
        $blog_translates = SliderTranslation::where('lang_code' , admin_lang())->get();

        foreach($blog_translates as $blog_translate){
            $new_trans = new SliderTranslation();
            $new_trans->lang_code = $lang_code;
            $new_trans->slider_id = $blog_translate->slider_id;
            $new_trans->title = $blog_translate->title;
            $new_trans->small_text = $blog_translate->small_text;
            $new_trans->button_text = $blog_translate->button_text;
            $new_trans->save();

        }
    }
}

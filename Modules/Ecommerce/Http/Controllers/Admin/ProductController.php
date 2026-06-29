<?php

namespace Modules\Ecommerce\Http\Controllers\Admin;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Modules\Brand\Entities\Brand;
use Modules\Category\Entities\Category;
use Modules\Ecommerce\Entities\Product;
use Modules\Ecommerce\Entities\ProductGallery;
use Modules\Ecommerce\Entities\ProductReview;
use Modules\Ecommerce\Entities\ProductTranslation;
use Modules\Language\App\Models\Language;
use Modules\Ecommerce\Entities\Order;
use Modules\Ecommerce\Entities\OrderDetail;
use Modules\Ecommerce\Entities\Cart;
use App\Models\Wishlist;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();

        return view('ecommerce::admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::with('translate')->where('status', 'enable')->get();
        $brands = Brand::with('translate')->where('status', 'enable')->get();

        return view('ecommerce::admin.products.create', compact('categories', 'brands'));
    }

    public function store(Request $request, $id = null)
    {
       $request->validate([
           'name' => 'required|string|max:255',
           'slug' => ['required', 'string', 'max:255', Rule::unique('products', 'slug')->ignore($id)],
           'price' => 'required|numeric|min:0',
           'offer_price' => 'nullable|numeric|min:0|lt:price|max:100',
           'description' => 'required|string',
           'category_id' => 'required|exists:categories,id',
           'thumbnail_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
           'seo_title' => 'nullable|string|max:255',
           'seo_description' => 'nullable|string|max:500',
           'is_digital' => 'nullable|boolean',
           'download_url' => 'required_if:is_digital,1|nullable|url|max:2000',
       ]);

        // Check if we are creating a new product or updating an existing one
        $product = $id ? Product::findOrFail($id) : new Product();
        $product->slug = $request->slug;
        $product->price = $request->price;
        $product->tags = $request->input('tags') ?? '[]';
        $product->offer_price = $request->filled('offer_price') ? $request->offer_price : null;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->status = Status::ENABLE;
        $product->is_digital = $request->boolean('is_digital');
        $product->download_url = $request->boolean('is_digital') ? $request->download_url : null;
        $product->quantity = $request->input('quantity', 0);

        // Handle image upload and watermarking
        if ($request->hasFile('thumbnail_image')) {
            $old_image = $id ? $product->thumbnail_image : null;
            if ($old_image) app(\App\Services\UploadManager::class)->delete($old_image);
            $product->thumbnail_image = app(\App\Services\UploadManager::class)->upload(
                $request->file('thumbnail_image'), 'uploads/custom-images', ['format' => 'webp', 'quality' => 80, 'prefix' => 'listing']
            );
        }

        $product->save();

        // Handle product translations
        $languages = Language::all();
        foreach ($languages as $language) {
            $listing_translate = ProductTranslation::firstOrNew([
                'lang_code' => $language->lang_code,
                'product_id' => $product->id,
            ]);

            $listing_translate->name = $request->name;
            $listing_translate->description = $request->description;
            $listing_translate->short_description = $request->short_description;
            $listing_translate->seo_title = $request->seo_title ?? $request->name;
            $listing_translate->seo_description = $request->seo_description ?? $request->name;
            $listing_translate->save();
        }

        $notification = trans('' . ($id ? 'Updated Successfully' : 'Created Successfully'));
        $notification = array('message' => $notification, 'alert-type' => 'success');

        return redirect()->route('admin.product.index')->with($notification);
    }

    public function edit(Request $request)
    {
        $id = $request->product_id;
        $lang_code = $request->lang_code;

        $categories = Category::with('translate')->where('status', 'enable')->get();
        $brands = Brand::with('translate')->where('status', 'enable')->get();
        $product = Product::findOrFail($id);

        $listing_translate = ProductTranslation::where(['product_id' => $id, 'lang_code' =>  $lang_code])->first();

        return view('ecommerce::admin.products.edit', compact('brands','categories', 'product', 'listing_translate'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $listing = Product::findOrFail($id);

        if($request->lang_code == admin_lang()){

                $product = Product::findOrFail($id);
                $product->slug = $request->slug;
                $product->price = $request->price;
                $product->offer_price = $request->filled('offer_price') ? $request->offer_price : null;
                $product->category_id = $request->category_id;
                $product->brand_id = $request->brand_id;
                $product->tags = $request->tags;
                $product->status = Status::ENABLE;
                $product->is_digital = $request->boolean('is_digital');
                $product->download_url = $request->boolean('is_digital') ? $request->download_url : null;

                if ($request->hasFile('thumbnail_image')) {
                    $old_image = $product->thumbnail_image;
                    if ($old_image) app(\App\Services\UploadManager::class)->delete($old_image);
                    $product->thumbnail_image = app(\App\Services\UploadManager::class)->upload(
                        $request->file('thumbnail_image'), 'uploads/custom-images', ['format' => 'webp', 'quality' => 80, 'prefix' => 'listing']
                    );
                }

                $product->save();
        }

        $listing_translate = ProductTranslation::findOrFail($request->translate_id);
        $listing_translate->name = $request->name;
        $listing_translate->description = $request->description;
        $listing_translate->short_description = $request->short_description;
        $listing_translate->seo_title = $request->seo_title;
        $listing_translate->seo_description = $request->seo_description;
        $listing_translate->save();

        $notification = trans('' . ($id ? 'Updated Successfully' : 'Created Successfully'));
        $notification = array('message' => $notification, 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $old_image = $product->thumbnail_image;

        if ($old_image) app(\App\Services\UploadManager::class)->delete($old_image);

        ProductTranslation::where('product_id',$id)->delete();
        ProductReview::where('product_id',$id)->delete();
        Cart::where('product_id',$id)->delete();
        Wishlist::where('product_id',$id)->delete();

        $galleries = ProductGallery::where('product_id', $id)->get();
        foreach($galleries as $gallery){
            if ($gallery->image) app(\App\Services\UploadManager::class)->delete($gallery->image);
            $gallery->delete();
        }

        $order_detils = OrderDetail::where('product_id', $id)->get();
        foreach($order_detils as $order_detils){
            Order::where('id',$order_detils->order_id)->delete();
            $order_detils->delete();
        }

        $product->delete();

        $notification=  trans('Delete Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.product.index')->with($notification);
    }

    public function status($id)
    {
        $product = Product::findOrFail($id);
        if($product->status == Status::ENABLE){
            $product->status = Status::DISABLE;
            $product->save();
            $message = trans('Status Changed Successfully');
        }else{
            $product->status = Status::ENABLE;
            $product->save();
            $message = trans('Status Changed Successfully');
        }
        return response()->json($message);
    }

    public function gallery($id)
    {
        $product = Product::findOrFail($id);
        $galleries = ProductGallery::where('product_id', $id)->get();

        return view('ecommerce::admin.products.gallery', compact('product', 'galleries'));
    }

    public function uploadGallery(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        foreach ($request->file as $index => $image) {
            $gallery_image = new ProductGallery();

            if($image) {
                $gallery_image->image = app(\App\Services\UploadManager::class)->upload(
                    $image, 'uploads/custom-images', ['format' => 'webp', 'quality' => 80, 'prefix' => 'listing']
                );
            }

            $gallery_image->product_id = $id;
            $gallery_image->save();
        }

        if ($gallery_image) {
            return response()->json([
                'message' => trans('Images uploaded successfully'),
                'url' => route('admin.product.gallery', $id),
            ]);
        } else {
            return response()->json([
                'message' => trans('Images uploaded Failed'),
                'url' => route('admin.product.gallery', $id),
            ]);
        }
    }

    public function deleteGallery($id){

        $gallery = ProductGallery::findOrFail($id);
        $gallery->delete();

        $notification=  trans('Delete Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

    public function assign_language($lang_code){
        $product_translates = ProductTranslation::where('lang_code', admin_lang())->get();
        foreach($product_translates as $product_translate){
            $product_translate_new = new ProductTranslation();
            $product_translate_new->lang_code = $lang_code;
            $product_translate_new->product_id = $product_translate->product_id;
            $product_translate_new->name = $product_translate->name;
            $product_translate_new->description = $product_translate->description;
            $product_translate_new->seo_title = $product_translate->seo_title;
            $product_translate_new->seo_description = $product_translate->seo_description;
            $product_translate_new->save();
        }
    }

    public function review_list()
    {
        $reviews = ProductReview::latest()->get();

        return view('ecommerce::admin.products.reviews', ['reviews' => $reviews]);
    }

    public function setup_language($lang_code){
        $blog_translates = ProductTranslation::where('lang_code' , admin_lang())->get();

        foreach($blog_translates as $translate){
            $new_trans = new ProductTranslation();
            $new_trans->lang_code = $lang_code;
            $new_trans->product_id = $translate->product_id;
            $new_trans->name = $translate->name;
            $new_trans->description = $translate->description;
            $new_trans->seo_title = $translate->seo_title;
            $new_trans->seo_description = $translate->seo_description;
            $new_trans->save();

        }
    }

}

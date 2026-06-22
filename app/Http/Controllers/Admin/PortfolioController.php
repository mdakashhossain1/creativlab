<?php

namespace App\Http\Controllers\Admin;

use App\Models\PortfolioCategory;
use App\Models\PortfolioItem;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PortfolioController extends Controller
{
    public function index()
    {
        $categories = PortfolioCategory::withCount('items')->latest()->get();
        return view('admin.portfolio.index', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);

        PortfolioCategory::create([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name) . '-' . time(),
            'description' => $request->description,
        ]);

        $notify = ['message' => 'Category created successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notify);
    }

    public function destroyCategory($id)
    {
        PortfolioCategory::findOrFail($id)->delete();
        $notify = ['message' => 'Category deleted', 'alert-type' => 'success'];
        return redirect()->back()->with($notify);
    }

    public function items($categoryId)
    {
        $category = PortfolioCategory::with('items')->findOrFail($categoryId);
        return view('admin.portfolio.items', compact('category'));
    }

    public function storeItem(Request $request, $categoryId)
    {
        $request->validate([
            'type'           => 'required|in:image,video,bunny',
            'content_source' => 'required|string',
            'thumbnail'      => 'nullable|string',
            'title'          => 'nullable|string|max:255',
            'description'    => 'nullable|string',
        ]);

        PortfolioCategory::findOrFail($categoryId);

        PortfolioItem::create([
            'portfolio_category_id' => $categoryId,
            'type'                  => $request->type,
            'content_source'        => $request->content_source,
            'thumbnail'             => $request->thumbnail,
            'title'                 => $request->title,
            'description'           => $request->description,
        ]);

        $notify = ['message' => 'Item added successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notify);
    }

    public function destroyItem($id)
    {
        PortfolioItem::findOrFail($id)->delete();
        $notify = ['message' => 'Item deleted', 'alert-type' => 'success'];
        return redirect()->back()->with($notify);
    }
}

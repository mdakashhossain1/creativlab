<?php

namespace Modules\Project\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\Project\App\Models\PortfolioCategory;

class PortfolioCategoryController extends Controller
{
    public function index()
    {
        $categories = PortfolioCategory::withCount('projects', 'portfolioItems')->latest()->get();
        return view('project::portfolio-category.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $slug = Str::slug($request->name);
        $orig = $slug;
        $i    = 1;
        while (PortfolioCategory::where('slug', $slug)->exists()) {
            $slug = $orig . '-' . $i++;
        }

        PortfolioCategory::create([
            'name'        => $request->name,
            'slug'        => $slug,
            'description' => $request->input('description', ''),
        ]);

        return redirect()->route('admin.portfolio-category.index')
            ->with(['message' => trans('Created Successfully'), 'alert-type' => 'success']);
    }

    public function update(Request $request, $id)
    {
        $cat = PortfolioCategory::findOrFail($id);
        $request->validate(['name' => 'required|string|max:255']);

        $cat->name        = $request->name;
        $cat->description = $request->input('description', '');
        $cat->save();

        return redirect()->route('admin.portfolio-category.index')
            ->with(['message' => trans('Updated Successfully'), 'alert-type' => 'success']);
    }

    public function destroy($id)
    {
        PortfolioCategory::findOrFail($id)->delete();

        return redirect()->route('admin.portfolio-category.index')
            ->with(['message' => trans('Delete Successfully'), 'alert-type' => 'success']);
    }
}

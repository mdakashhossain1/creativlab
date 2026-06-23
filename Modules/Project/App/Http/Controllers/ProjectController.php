<?php

namespace Modules\Project\App\Http\Controllers;

use Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\RedirectResponse;
use Modules\Project\App\Models\Project;
use Modules\Project\App\Models\PortfolioCategory;
use Modules\Project\App\Models\PortfolioItem;
use Modules\Language\App\Models\Language;
use Modules\Project\App\Models\ProjectGallery;
use Modules\Project\App\Models\ProjectTranslation;
use Modules\GlobalSetting\App\Models\GlobalSetting;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('translate', 'portfolioCategory')->latest()->get();
        return view('project::index', compact('projects'));
    }

    public function create()
    {
        $categories    = PortfolioCategory::orderBy('name')->get();
        $theme_setting = GlobalSetting::where('key', 'selected_theme')->first();
        return view('project::create', compact('categories', 'theme_setting'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'thumb_image'        => 'required|image|mimes:jpeg,png,jpg,webp',
            'portfolio_category_id' => 'required|exists:portfolio_categories,id',
            'slug'               => 'required|unique:projects,slug',
            'website_url'        => 'required',
            'project_date'       => 'required|date',
            'title'              => 'required|string|max:255',
            'short_description'  => 'required|string|max:255',
            'description'        => 'required|string',
            'client_name'        => 'required|string|max:255',
            'seo_title'          => 'nullable|string|max:255',
            'seo_description'    => 'nullable|string',
            'video_url'          => 'nullable',
            'author_image'       => 'nullable|image|mimes:jpeg,png,jpg,webp',
            'author_name'        => 'nullable|string|max:255',
            'author_designation' => 'nullable|string|max:255',
            'author_comment'     => 'nullable|string',
        ]);

        $project = new Project();

        if ($request->thumb_image) {
            $image_name = 'project' . date('-Y-m-d-h-i-s-') . rand(999, 9999) . '.webp';
            $image_name = 'uploads/custom-images/' . $image_name;
            Image::make($request->thumb_image)->encode('webp', 80)->save(public_path() . '/' . $image_name);
            $project->thumb_image = $image_name;
        }

        if ($request->author_image) {
            $image_name = 'project-author' . date('-Y-m-d-h-i-s-') . rand(999, 9999) . '.webp';
            $image_name = 'uploads/custom-images/' . $image_name;
            Image::make($request->author_image)->encode('webp', 80)->save(public_path() . '/' . $image_name);
            $project->author_image = $image_name;
        }

        $project->portfolio_category_id = $request->portfolio_category_id;
        $project->slug                   = $request->slug;
        $project->website_url            = $request->website_url;
        $project->project_date           = $request->project_date;
        $project->project_fb             = $request->input('project_fb', '');
        $project->project_x              = $request->input('project_x', '');
        $project->project_linkedin       = $request->input('project_linkedin', '');
        $project->project_instagram      = $request->input('project_instagram', '');
        $project->status                 = 'enable';
        $project->video_url              = $request->input('video_url', '');
        $project->author_name            = $request->input('author_name', '');
        $project->author_designation     = $request->input('author_designation', '');
        $project->save();

        foreach (Language::all() as $language) {
            $pt = new ProjectTranslation();
            $pt->lang_code         = $language->lang_code;
            $pt->project_id        = $project->id;
            $pt->title             = $request->title;
            $pt->description       = $request->description;
            $pt->short_description = $request->short_description;
            $pt->client_name       = $request->client_name;
            $pt->seo_title         = $request->seo_title ?: $request->title;
            $pt->seo_description   = $request->seo_description ?: $request->title;
            $pt->author_comment    = $request->author_comment;
            $pt->save();
        }

        return redirect()->route('admin.project.index')
            ->with(['message' => trans('Created Successfully'), 'alert-type' => 'success']);
    }

    public function edit(Request $request, $id)
    {
        $project           = Project::findOrFail($id);
        $project_translate = ProjectTranslation::where(['project_id' => $id, 'lang_code' => $request->lang_code])->first();
        $categories        = PortfolioCategory::orderBy('name')->get();
        $theme_setting     = GlobalSetting::where('key', 'selected_theme')->first();

        return view('project::edit', compact('project', 'project_translate', 'categories', 'theme_setting'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $project = Project::findOrFail($id);

        if ($request->lang_code == admin_lang()) {
            $request->validate([
                'thumb_image'           => 'nullable|image|mimes:jpeg,png,jpg,webp',
                'portfolio_category_id' => 'required|exists:portfolio_categories,id',
                'slug'                  => 'required|unique:projects,slug,' . $id,
                'website_url'           => 'required',
                'project_date'          => 'required|date',
                'author_image'          => 'nullable|image|mimes:jpeg,png,jpg,webp',
                'author_name'           => 'nullable|string|max:255',
                'author_designation'    => 'nullable|string|max:255',
            ]);

            if ($request->thumb_image) {
                $image_name = 'project' . date('-Y-m-d-h-i-s-') . rand(999, 9999) . '.webp';
                $image_name = 'uploads/custom-images/' . $image_name;
                Image::make($request->thumb_image)->encode('webp', 80)->save(public_path() . '/' . $image_name);
                $project->thumb_image = $image_name;
            }

            if ($request->author_image) {
                $old = $project->author_image;
                $image_name = 'project-author' . date('-Y-m-d-h-i-s-') . rand(999, 9999) . '.webp';
                $image_name = 'uploads/custom-images/' . $image_name;
                Image::make($request->author_image)->encode('webp', 80)->save(public_path() . '/' . $image_name);
                $project->author_image = $image_name;
                if ($old && File::exists(public_path() . '/' . $old)) unlink(public_path() . '/' . $old);
            }

            $project->portfolio_category_id = $request->portfolio_category_id;
            $project->slug                   = $request->slug;
            $project->website_url            = $request->website_url;
            $project->project_date           = $request->project_date;
            $project->project_fb             = $request->input('project_fb', '');
            $project->project_x              = $request->input('project_x', '');
            $project->project_linkedin       = $request->input('project_linkedin', '');
            $project->project_instagram      = $request->input('project_instagram', '');
            $project->video_url              = $request->input('video_url', '');
            $project->author_name            = $request->input('author_name', '');
            $project->author_designation     = $request->input('author_designation', '');
            $project->save();
        }

        $request->validate([
            'title'             => 'required|string|max:255',
            'short_description' => 'required|string|max:255',
            'description'       => 'required|string',
            'client_name'       => 'required|string|max:255',
            'seo_title'         => 'nullable|string|max:255',
            'seo_description'   => 'nullable|string',
            'author_comment'    => 'nullable|string',
        ]);

        $pt = ProjectTranslation::findOrFail($request->translate_id);
        $pt->title             = $request->title;
        $pt->description       = $request->description;
        $pt->short_description = $request->short_description;
        $pt->client_name       = $request->client_name;
        $pt->seo_title         = $request->seo_title;
        $pt->seo_description   = $request->seo_description;
        $pt->author_comment    = $request->author_comment;
        $pt->save();

        return redirect()->back()
            ->with(['message' => trans('Updated Successfully'), 'alert-type' => 'success']);
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        if ($project->thumb_image && File::exists(public_path() . '/' . $project->thumb_image)) {
            unlink(public_path() . '/' . $project->thumb_image);
        }

        ProjectTranslation::where('project_id', $id)->delete();

        foreach (ProjectGallery::where('project_id', $id)->get() as $gallery) {
            if ($gallery->image && File::exists(public_path() . '/' . $gallery->image)) {
                unlink(public_path() . '/' . $gallery->image);
            }
            $gallery->delete();
        }

        // Delete portfolio items belonging to this project
        foreach (PortfolioItem::where('project_id', $id)->get() as $item) {
            if ($item->thumbnail && File::exists(public_path() . '/' . $item->thumbnail)) {
                unlink(public_path() . '/' . $item->thumbnail);
            }
            $item->delete();
        }

        $project->delete();

        return redirect()->route('admin.project.index')
            ->with(['message' => trans('Delete Successfully'), 'alert-type' => 'success']);
    }

    // ── Portfolio Items (sub-items within a project) ───────────────

    public function portfolioItems($project_id)
    {
        $project = Project::with('portfolioCategory')->findOrFail($project_id);
        $items   = PortfolioItem::with('portfolioCategory')
            ->where('project_id', $project_id)
            ->latest()
            ->get();
        $categories = PortfolioCategory::orderBy('name')->get();

        return view('project::portfolio-items', compact('project', 'items', 'categories'));
    }

    public function storePortfolioItem(Request $request, $project_id)
    {
        $project = Project::findOrFail($project_id);

        $request->validate([
            'portfolio_category_id' => 'required|exists:portfolio_categories,id',
            'type'                  => 'required|in:image,video,bunny',
            'content_source'        => 'required',
            'thumbnail'             => 'nullable|image|mimes:jpeg,png,jpg,webp',
            'title'                 => 'nullable|string|max:255',
            'description'           => 'nullable|string',
        ]);

        $item = new PortfolioItem();
        $item->project_id              = $project->id;
        $item->portfolio_category_id   = $request->portfolio_category_id;
        $item->type                    = $request->type;
        $item->content_source          = $request->content_source;
        $item->title                   = $request->input('title', '');
        $item->description             = $request->input('description', '');

        if ($request->hasFile('thumbnail')) {
            $name = 'portfolio-thumb' . date('-Y-m-d-h-i-s-') . rand(999, 9999) . '.webp';
            $name = 'uploads/custom-images/' . $name;
            Image::make($request->thumbnail)->encode('webp', 80)->save(public_path() . '/' . $name);
            $item->thumbnail = $name;
        }

        $item->save();

        return redirect()->route('admin.project-items', $project_id)
            ->with(['message' => trans('Item added successfully'), 'alert-type' => 'success']);
    }

    public function deletePortfolioItem($id)
    {
        $item = PortfolioItem::findOrFail($id);
        $project_id = $item->project_id;

        if ($item->thumbnail && File::exists(public_path() . '/' . $item->thumbnail)) {
            unlink(public_path() . '/' . $item->thumbnail);
        }

        $item->delete();

        return redirect()->route('admin.project-items', $project_id)
            ->with(['message' => trans('Item deleted'), 'alert-type' => 'success']);
    }

    // ── Gallery (unchanged) ────────────────────────────────────────

    public function listing_project($id)
    {
        $project  = Project::findOrFail($id);
        $galleries = ProjectGallery::where('project_id', $id)->get();
        return view('project::gallery', compact('project', 'galleries'));
    }

    public function upload_listing_project(Request $request, $id)
    {
        $gallery_image = null;
        foreach ($request->file as $index => $image) {
            $gallery_image = new ProjectGallery();
            if ($image) {
                $image_name = 'project-gallery' . date('-Y-m-d-h-i-s-') . rand(999, 9999) . $index . '.webp';
                $image_name = 'uploads/custom-images/' . $image_name;
                Image::make($image)->encode('webp', 80)->save(public_path() . '/' . $image_name);
                $gallery_image->image = $image_name;
            }
            $gallery_image->project_id = $id;
            $gallery_image->save();
        }

        if ($gallery_image) {
            return response()->json(['message' => trans('Images uploaded successfully'), 'url' => route('admin.project-gallery', $id)]);
        }
        return response()->json(['message' => trans('Images uploaded Failed'), 'url' => route('admin.project-gallery', $id)]);
    }

    public function delete_listing_project($id)
    {
        $gallery = ProjectGallery::findOrFail($id);
        if ($gallery->image && File::exists(public_path() . '/' . $gallery->image)) {
            unlink(public_path() . '/' . $gallery->image);
        }
        $gallery->delete();

        return redirect()->back()
            ->with(['message' => trans('Delete Successfully'), 'alert-type' => 'success']);
    }

    public function setup_language($lang_code)
    {
        foreach (ProjectTranslation::where('lang_code', admin_lang())->get() as $t) {
            $new = new ProjectTranslation();
            $new->project_id  = $t->project_id;
            $new->lang_code   = $lang_code;
            $new->title       = $t->title;
            $new->client_name = $t->client_name;
            $new->description = $t->description;
            $new->save();
        }
    }
}

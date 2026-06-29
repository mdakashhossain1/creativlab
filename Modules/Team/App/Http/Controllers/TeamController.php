<?php

namespace Modules\Team\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\TeamTranslation;
use App\Services\UploadManager;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Language\App\Models\Language;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::latest()->get();
        return view('team::index', compact('teams'));
    }

    public function create()
    {
        return view('team::create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'         => 'required|string',
            'slug'         => 'required|string',
            'image'        => 'required|image',
            'description'  => 'required|string',
            'designation'  => 'required|string',
            'mail'         => 'required|email',
            'phone_number' => 'required|string',
            'facebook'     => 'nullable|string',
            'twitter'      => 'nullable|string',
            'linkedin'     => 'nullable|string',
            'instagram'    => 'nullable|string',
        ]);

        $team = new Team();

        if ($request->image) {
            $team->image = app(UploadManager::class)->upload(
                $request->image, 'uploads/custom-images', ['prefix' => 'team', 'format' => 'webp', 'quality' => 80]
            );
        }

        $team->slug         = $request->slug;
        $team->mail         = $request->mail;
        $team->phone_number = $request->phone_number;
        $team->facebook     = $request->facebook;
        $team->twitter      = $request->twitter;
        $team->linkedin     = $request->linkedin;
        $team->instagram    = $request->instagram;
        $team->save();

        $languages = Language::all();
        foreach ($languages as $language) {
            $team_translate = TeamTranslation::firstOrNew([
                'lang_code' => $language->lang_code,
                'team_id'   => $team->id,
            ]);
            $team_translate->name        = $request->name;
            $team_translate->description = $request->description;
            $team_translate->designation = $request->designation;
            $team_translate->save();
        }

        $notify_message = array('message' => trans('Created Successfully'), 'alert-type' => 'success');
        return redirect()->route('admin.team.index')->with($notify_message);
    }

    public function edit(Request $request, $id)
    {
        $teamMember    = Team::findOrFail($id);
        $team_translate = TeamTranslation::where(['team_id' => $id, 'lang_code' => $request->lang_code])->first();
        return view('team::edit', compact('teamMember', 'team_translate'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $team = Team::findOrFail($id);

        if ($request->lang_code == admin_lang()) {
            $request->validate([
                'image'        => 'nullable|image',
                'slug'         => 'required|string|unique:teams,slug,' . $id,
                'mail'         => 'required|email',
                'phone_number' => 'required|string',
                'facebook'     => 'nullable|string|url',
                'twitter'      => 'nullable|string|url',
                'linkedin'     => 'nullable|string|url',
                'instagram'    => 'nullable|string|url',
            ]);

            if ($request->image) {
                $old_image  = $team->image;
                $team->image = app(UploadManager::class)->upload(
                    $request->image, 'uploads/custom-images', ['prefix' => 'team', 'format' => 'webp', 'quality' => 80]
                );
                $team->save();
                app(UploadManager::class)->delete($old_image);
            }

            $team->slug         = $request->slug;
            $team->mail         = $request->mail;
            $team->phone_number = $request->phone_number;
            $team->facebook     = $request->facebook;
            $team->twitter      = $request->twitter;
            $team->linkedin     = $request->linkedin;
            $team->instagram    = $request->instagram;
            $team->save();
        }

        $team_translate              = TeamTranslation::where(['id' => $request->team_id])->first();
        $team_translate->name        = $request->name;
        $team_translate->designation = $request->designation;
        $team_translate->description = $request->description;
        $team_translate->save();

        $notify_message = array('message' => trans('Updated Successfully'), 'alert-type' => 'success');
        return redirect()->back()->with($notify_message);
    }

    public function destroy($id): RedirectResponse
    {
        $team = Team::findOrFail($id);
        app(UploadManager::class)->delete($team->image);
        TeamTranslation::where('team_id', $id)->delete();
        $team->delete();

        $notify_message = array('message' => trans('Delete Successfully'), 'alert-type' => 'success');
        return redirect()->route('admin.team.index')->with($notify_message);
    }

    public function setup_language($lang_code)
    {
        $blog_translates = TeamTranslation::where('lang_code', admin_lang())->get();
        foreach ($blog_translates as $team_translate) {
            $new_trans              = new TeamTranslation();
            $new_trans->lang_code   = $lang_code;
            $new_trans->team_id     = $team_translate->team_id;
            $new_trans->name        = $team_translate->name;
            $new_trans->description = $team_translate->description;
            $new_trans->designation = $team_translate->designation;
            $new_trans->save();
        }
    }
}

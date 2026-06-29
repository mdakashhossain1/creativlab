<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Auth, Hash;
use App\Http\Requests\EditProfileRequest;
use App\Http\Requests\PasswordChangeRequest;


class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function edit_profile(){

        $admin = Auth::guard('admin')->user();
        return view('admin.edit_profile', ['admin' => $admin]);
    }

    public function profile_update(EditProfileRequest $request){

        $admin = Auth::guard('admin')->user();

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->designation = $request->designation;
        $admin->facebook = $request->facebook;
        $admin->linkedin = $request->linkedin;
        $admin->twitter = $request->twitter;
        $admin->instagram = $request->instagram;
        $admin->about_me = $request->about_me;
        $admin->save();


        if($request->hasFile('image')){
            $old_image = $admin->image;
            $admin->image = app(\App\Services\UploadManager::class)->upload($request->image, 'uploads/website-images', ['prefix' => 'admin']);
            $admin->save();
            if($old_image){
                app(\App\Services\UploadManager::class)->delete($old_image);
            }
        }

        $notify_message = trans('Update successfully');
        $notify_message = array('message' => $notify_message, 'alert-type' => 'success');
        return redirect()->back()->with($notify_message);
    }

    public function update_password(PasswordChangeRequest $request){

        $admin = Auth::guard('admin')->user();

        if(Hash::check($request->current_password, $admin->password)){
            $admin->password = Hash::make($request->password);
            $admin->save();

            $notify_message = trans('Password changed successfully');
            $notify_message = array('message' => $notify_message, 'alert-type' => 'success');
            return redirect()->back()->with($notify_message);

        }else{
            $notify_message = trans('Current password does not match');
            $notify_message = array('message' => $notify_message, 'alert-type' => 'error');
            return redirect()->back()->with($notify_message);
        }


    }
}

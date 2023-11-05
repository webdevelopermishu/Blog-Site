<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    function profile(){
        return view('admin.user.profile');
    }
    function edit_profile(){
        return view('admin.user.edit_profile');
    }
    function update_profile(Request $request){
        if($request->photo==''){
            User::find(Auth::id())->update([
                'name'=>$request->name,
            ]);
            return back()->with('success', 'Name Updated!');
        }
        else{
            $photo = $request->photo;
            $extension = $photo->extension();
            $file_name = Auth::id().'.'.$extension;
            Image::make($photo)->save(public_path('uploads/users/'.$file_name));
            User::find(Auth::id())->update([
                'name'=>$request->name,
                'photo'=>$file_name,
            ]);
            return back()->with('success', 'Name & Image Updated!');
        }
    }

    function user_list(){
        $users = User::all();
        return view('admin.user.user_list', compact('users'));
    }
    function password_update(Request $request){
        $request->validate([
            'current_password'=>'required',
            'password'=>['required','confirmed', Password::min(8)
            ->letters()
            ->mixedCase()
            ->numbers()
            ->symbols()],
            'password_confirmation'=>'required',
        ],[
            'current_password.required'=>'Current Password Required!',
        ]);

        if(Hash::check($request->current_password, Auth::user()->password)){
            User::find(Auth::id())->update([
                'password'=>bcrypt($request->password),
            ]);
            return back()->with('pass_changed', 'Password Updated!');
        }
        else{
            return back()->with('wrong', 'Password does not match!');
        }
    }
    function delete_user($id){
        User::find($id)->delete();
        return back()->with('deleted', 'User Deleted!');
    }
}

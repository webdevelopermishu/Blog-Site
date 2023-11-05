<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorLoginController extends Controller
{
    function login_confirm(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);
        if(Author::where('email', $request->email)->exists()){
            if(Auth::guard('author')->attempt(['email'=>$request->email, 'password'=>$request->password])){
                if(Auth::guard('author')->user()->email_verified_at == null){
                    Auth::guard('author')->logout();
                    return back()->with('unverified', 'Please verify your email first!');
                }
                else{
                    return redirect()->route('index');
                }
            }
            else{
                return back()->with('passerror', 'Please enter your correct password');
            }
        }
        else{
            return back()->with('notexist', 'Please Register First!');
        }
    }
}

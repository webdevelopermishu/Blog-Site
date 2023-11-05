<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use \Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    function google_redirect(){
        return Socialite::driver('google')->redirect();
    }
    function google_callback(){
        $user = Socialite::driver('google')->user();

        if(Author::where('email', $user->getEmail())->exists()){
            if(Auth::guard('author')->attempt(['email'=>$user->getEmail(), 'password'=>'abcd1234@'])){
                return redirect()->route('index');
            }
            else{
                return redirect()->route('auth.login')->with('error', 'Something went wrong!');
            }
        }
        else{
            Author::insert([
                'username'=>$user->getName(),
                'email'=>$user->getEmail(),
                'password'=>bcrypt('abcd1234@'),
            ]);
            if(Auth::guard('author')->attempt(['email'=>$user->getEmail(), 'password'=>'abcd1234@'])){
                return redirect()->route('index');
            }
        }

    }
}



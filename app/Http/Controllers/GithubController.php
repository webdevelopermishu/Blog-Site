<?php

namespace App\Http\Controllers;

use App\Models\Author;
use \Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class GithubController extends Controller
{
    function githaub_redirect(){
        return Socialite::driver('github')->redirect();
    }
    function github_callback(){
        $user = Socialite::driver('github')->user();

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

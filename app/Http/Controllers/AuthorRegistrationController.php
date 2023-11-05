<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Mailverify;
use App\Notifications\MailverifyNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class AuthorRegistrationController extends Controller
{
    function author_registration_store(Request $request){
        $request->validate([
            'username'=>'required',
            'email'=>'required',
            'password'=>'required',

        ]);
        $info = Author::create([
            'username'=>$request->username,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'created_at'=>Carbon::now(),
        ]);
        $verify = Mailverify::create([
            'author_id'=> $info->id,
            'token'=> uniqid(),
        ]);
        Notification::send($info, new MailverifyNotification($verify));
        return back()->with('registered', "User Registered! Please verify your mail, we have sent you a verify link through '$request->email'");
    }
    function mail_verify($token){
        $author = Mailverify::where('token', $token)->first();
        if(Mailverify::where('token', $token)->exists()){
            Author::find($author->author_id)->update([
                'email_verified_at'=>Carbon::now(),
            ]);
        }
        else{
            return redirect()->route('author.login')->with('time_out', 'Service Expired!');
        }
        Mailverify::where('token', $token)->delete();
        return redirect()->route('author.login')->with('verified', 'Email Verified!');

    }
}

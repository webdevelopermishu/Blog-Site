<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\PassReset;
use App\Notifications\PassResetNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class PasswordResetController extends Controller
{
    function pass_reset_controller(){
        return view('frontend.pass_reset_req');
    }
    function reset_req_send(Request $request){
        $request->validate([
            'email'=> 'required',
        ]);
        if(Author::where('email', $request->email)->exists()){
            $author  = Author::where('email', $request->email)->first();
            PassReset::where('author_id', $author->id)->delete();
            $reset_info = PassReset::create([
                'author_id'=>$author->id,
                'token'=>uniqid(),
            ]);
            Notification::send($author, new PassResetNotification($reset_info));
            return back()->with('mail_sent', "We have sent you a Password-Reset link through '$request->email'");
        }
        else{
            return back()->with('not_exist', 'Email Does not exists!');
        }
    }
    function reset_form($token){
        if(PassReset::where('token', $token)->exists()){
            return view('frontend.pass_reset_form', [
                'token'=>$token,
            ]);
        }
        else{
            return redirect()->route('pass.reset.req')->with('time_out', 'Service Expired!');
        }
    }
    function pass_reset_confirm(Request $request, $token){
            $author = PassReset::where('token', $token)->first();
            Author::find($author->author_id)->update([
                'password'=>bcrypt($request->password),
            ]);
            PassReset::where('token', $token)->delete();
            return redirect()->route('author.login')->with('changed', 'Password Updated!');
    }
}

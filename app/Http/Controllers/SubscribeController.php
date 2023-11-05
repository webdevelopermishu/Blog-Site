<?php

namespace App\Http\Controllers;

use App\Mail\SubscribeMail;
use App\Models\Subscribe;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class SubscribeController extends Controller
{
    function subs_store(Request $request){
        if($request->email==''){
            return redirect()->route('index', '#subs')->with('error', 'Please Enter Your Email');
        }
        else{
            Subscribe::Insert([
                'email'=>$request->email,
                'created_at'=>Carbon::now(),
            ]);
            return redirect()->route('index', '#subs')->with('success', 'Subscribed');
        }

        // $request->validate([
        //     'email'=>'required'
        // ]);
    }
    function subscribers(){
        $subscribers = Subscribe::all();
        return view('admin.subscriber.subscribers', [
            'subscribers'=>$subscribers,
        ]);
    }
    function subs_delete($id){
        Subscribe::find($id)->delete();
        return back()->with('delete', 'Deleted!');
    }
    function send_mail($id){
        $subscriber = Subscribe::find($id);
        $email = $subscriber->email;
        $status = $subscriber->status;
        if($status==0){
            Mail::to($email)->send(new SubscribeMail($email));
            Subscribe::find($id)->update([
                'status'=>1
            ]);
            return back()->with('sent', 'Mail has sent!');
        }
        else{
            return back();
        }

    }
}

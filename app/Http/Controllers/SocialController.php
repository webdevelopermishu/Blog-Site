<?php

namespace App\Http\Controllers;

use App\Models\social;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class SocialController extends Controller
{
    function social(){
        $socials = social::all();
        return view('admin.social.social',[
            'socials'=>$socials,
        ]);
    }
    function social_store(Request $request){
        $request->validate([
            'media_icon'=>'required',
            'media_name'=>'required',
        ]);
        social::insert([
            'media_icon'=>$request->media_icon,
            'media_name'=>$request->media_name,
            'media_link'=>$request->media_link,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('success', 'Success');
    }
    function social_status_change($id){
        $social = social::find($id);
        if($social->status==0){
            social::find($id)->update([
                'status'=>1,
            ]);
            return back()->with('active', 'Activated');
        }
        else{
            social::find($id)->update([
                'status'=>0,
            ]);
            return back()->with('deactive', 'Deactivated');
        }
    }
    function social_delete($id){
        social::find($id)->delete();
        return back()->with('delete','Deleted');
    }
}

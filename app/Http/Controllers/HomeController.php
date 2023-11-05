<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\AuthorSocial;
use App\Models\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    function auth_req(){
        $lists = AuthRequest::where('status', 0)->get();
        return view('admin.author.auth_req', [
            'lists'=>$lists,
        ]);
    }
    function auth_list(){
        $lists = AuthRequest::where('status', 1)->get();
        return view('admin.author.auth_list', [
            'lists'=>$lists,
        ]);
    }
    function auth_req_accept($id){
        $author = AuthRequest::find($id);
        AuthRequest::find($id)->update([
            'status'=>1,
        ]);
        Author::find($author->author_id)->update([
            'author'=>1,
        ]);
        return back()->with('accepted', 'Request Accepted!');
    }
    function auth_deactive($id){
        $author = AuthRequest::find($id);
        AuthRequest::find($id)->update([
            'status'=>0,
        ]);
        Author::find($author->author_id)->update([
            'author'=>0,
        ]);
        return back()->with('Deactivated', 'Author Deactivated!');
    }
    function auth_req_delete($id){
        AuthRequest::find($id)->delete();
        return back()->with('deleted', 'Request Deleted!');
    }
    function auth_del($id){
        $author = AuthRequest::find($id);
        AuthRequest::find($id)->delete();
        Author::find($author->author_id)->update([
            'author'=>0,
        ]);
        return back()->with('deleted', 'Author Deleted!');
    }
    function author_social_store(Request $request){
        $request->validate([
            'media_icon'=>'required',
            'media_link'=>'required',
        ]);
        AuthorSocial::insert([
            'author_id'=>Auth::guard('author')->id(),
            'media_icon'=>$request->media_icon,
            'media_link'=>$request->media_link,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('stored', 'Stored');
    }


}

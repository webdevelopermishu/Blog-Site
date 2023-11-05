<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    function comments_store(Request $request){
        Comment::insert([
            'post_id'=>$request->post_id,
            'author_id'=>Auth::guard('author')->id(),
            'parent_id'=>$request->parent_id,
            'comments'=>$request->comments,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('commented', 'Your Comment or Reply Appear Down Bellow!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    function search(Request $request){
        $search_post = Post::where('title', 'like', '%'.$request->keyword.'%')->orWhere('desq', 'like', '%'.$request->keyword.'%')->get();
        return view('frontend.search',[
            'search_post'=>$search_post,
        ]);
    }
}

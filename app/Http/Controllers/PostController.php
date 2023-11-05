<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    function add_post(){
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.post.add_post', [
            'categories'=>$categories,
            'tags'=>$tags,
        ]);
    }
    function post_store(PostRequest $request){
        $slug = str_replace(' ','-', Str::lower($request->title)).'-'.random_int(55555, 66666).uniqid();
        $after_implode_tag = implode(',', $request->tags);

        // Thumbnail
        $thumbnail = $request->thumb;
        $extension = $thumbnail->extension();
        $thumb_name = str_replace(' ','-', Str::lower(substr($request->title, 0,10))).random_int(50000,100000).'.'.$extension;
        Image::make($thumbnail)->save(public_path('uploads/post/thumbnail/'.$thumb_name));

        // Cover
        $cover = $request->cover_image;
        $extension2 = $cover->extension();
        $cover_name = str_replace(' ','-', Str::lower(substr($request->title, 0,10))).random_int(50000,100000).'.'.$extension2;
        Image::make($cover)->save(public_path('uploads/post/cover_photo/'.$cover_name));

        Post::insert([
            'author_id'=>Auth::guard('author')->id(),
            'category_id'=>$request->category_id,
            'title'=>$request->title,
            'desq'=>$request->desq,
            'thumbnail'=>$thumb_name,
            'cover_image'=>$cover_name,
            'tags'=>$after_implode_tag,
            'slug'=>$slug,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('posted', 'Post is ready for approve!');
    }
    function post_list(){
        $posts = Post::where('author_id', Auth::guard('author')->id())->get();
        return view('admin.post.post_list',[
            'posts'=>$posts
        ]);
    }
    function status_change($id){
        $post = Post::find($id);
        if($post->status==0){
            Post::find($id)->update([
                'status'=>1
            ]);
        }
        else{
            Post::find($id)->update([
                'status'=>0
            ]);
        }
        return back()->with('changed', '--');
    }
    function post_delete($id){
        Post::find($id)->delete();
        return back()->with('delete', 'Deleted');
    }
}

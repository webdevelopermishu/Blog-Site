<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\AuthorSocial;
use App\Models\Category;
use App\Models\Comment;
use App\Models\PopularPost;
use App\Models\Post;
use App\Models\social;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class FrontendController extends Controller
{
    function welcome(){
        return view('welcome');
    }
    function welcome_front(){
        $days = \Carbon\Carbon::today()->subDays(7);
        $popular_post = PopularPost::where('created_at', '>=', $days)->OrderBy('total_read', 'DESC')->take(4)->get();
        $categories = Category::all();
        $post_slider = Post::latest()->take(4)->where('status', 1)->get();
        $post_recent = Post::latest()->where('status', 1)->paginate(6);
        $socials = social::where('status', 1)->get();
        $tags = Tag::latest()->take(100)->get();
        return view('frontend.index', [
            'categories'=>$categories,
            'post_slider'=>$post_slider,
            'post_recent'=>$post_recent,
            'tags'=>$tags,
            'socials'=>$socials,
            'popular_post'=>$popular_post,
        ]);
    }
    function author_login(){
        return view('frontend.login');
    }
    function author_reg(){
        return view('frontend.reg');
    }
    function blog_details($slug){
        $post = Post::where('slug', $slug)->first();
        $post_details = Post::find($post->id);
        $url = url()->current();
        $author_social = AuthorSocial::where('author_id', $post->author_id)->get();
        $shareButtons = \Share::page(
            "$url",
            "$post_details->title",
        )
        ->facebook()
        ->twitter()
        ->linkedin()
        ->telegram()
        ->whatsapp();
        if(PopularPost::where('post_id', $post->id)->exists()){
            PopularPost::where('post_id', $post->id)->increment('total_read', 1);
        }
        else{
            PopularPost::insert([
                'post_id'=> $post->id,
                'total_read'=>1,
                'created_at'=>Carbon::now(),
            ]);
        }
        $total_read = PopularPost::where('post_id', $post->id)->first()->total_read;
        $comments = Comment::with('replies')->where('post_id', $post->id)->whereNull('parent_id')->get();
        return view('frontend.blog_details',[
            'post_details'=>$post_details,
            'author_social'=>$author_social,
            'shareButtons'=>$shareButtons,
            'total_read'=>$total_read,
            'comments'=>$comments,
        ]);
        // $author_social = AuthorSocial::all();
        // where('author_id', $post->author_id)->get();
        // $socials = $author_social->;

    }
    function category_blog($id){
        $category_info = Category::find($id);
        $category_blogs = Post::where('category_id', $id)->get();
        return view('frontend.category_blog', [
            'category_info'=>$category_info,
            'category_blogs'=>$category_blogs,
        ]);
    }
    function author_blog($id){
        $author_info = Author::find($id);
        $socials = AuthorSocial::where('author_id', $id)->get();
        $author_blog = Post::where('author_id', $id)->paginate(10);
        return view('frontend.author_blog', [
            'author_info'=>$author_info,
            'author_blog'=>$author_blog,
            'socials'=>$socials,
        ]);
    }
    function all_blogs(){
        $all_blogs = Post::where('status', 1)->paginate(5);
        return view('frontend.all_blog', [
            'all_blogs'=>$all_blogs,
        ]);
    }
    function all_author_list(){
        $authors_list = Author::where('author', 1)->paginate(2);
        return view('frontend.all_author', [
            'authors_list'=>$authors_list,
        ]);
    }
    function tag_blog($id){
        $tag_info = Tag::find($id);
        $posts = Post::all();
        return view('frontend.tag_blog', [
            'tag_info'=>$tag_info,
            'posts'=>$posts,
        ]);
    }

}

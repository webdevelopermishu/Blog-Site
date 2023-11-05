<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TagController extends Controller
{
    function tag(){
        $tags = Tag::all();
        return view('admin.Tag.tag', compact('tags'));
    }
    function tag_store(Request $request){
        $request->validate([
            'tag_name'=>'required',
        ]);
        Tag::insert([
            'tag_name'=>$request->tag_name,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('added', 'New Tag Aded!');
    }
    function tag_delete($id){
        Tag::find($id)->delete();
        return back()->with('trashed', 'Moved to trash!');
    }
    function tag_trash(){
        $tags = Tag::onlyTrashed()->get();
        return view('admin.Tag.trash', [
            'tags'=>$tags
        ]);
    }
    function permanent_delete_tag($id){
        Tag::onlyTrashed()->find($id)->forceDelete();
        return back()->with('deleted','Permanently Deleted!');
    }
    function restore_tag($id){
        Tag::onlyTrashed()->find($id)->restore();
        return back()->with('restored', 'Restored!');
    }
    function checked_tag_action(Request $request){
        $request->validate([
            'tag_id'=>'required',
        ]);
        if($request->action_checked==1){
            foreach($request->tag_id as $tag){
                Tag::onlyTrashed()->find($tag)->restore();
                }
                return back()->with('checked_restored', 'Checked are Restored!');
        }
        else{
            foreach($request->tag_id as $tag){
                Tag::onlyTrashed()->find($tag)->forceDelete();
                }
                return back()->with('checked_delete', 'Checked are Deleted!');
        }
    }
    function checked_trash(Request $request){
        $request->validate([
            'tag_id'=>'required',
        ]);
        foreach($request->tag_id as $tag){
            Tag::find($tag)->delete();
        }
        return back()->with('checked_trashed', 'Checked are move to Trashed!');
    }
}

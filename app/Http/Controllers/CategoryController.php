<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    function category(){
        $categories = Category::all();
        return view('admin.Category.Category', compact('categories'));
    }
    function category_store(Request $request){
        $request->validate([
            'category_name'=>'required|unique:categories',
            'category_image'=>'required|image|mimes:png,jpg,webp,bmp| file|max:1024',
        ]);

        $image = $request->category_image;
        $extension = $image->extension();
        $file_name = str::lower(str_replace(' ','-', $request->category_name)).'-'.random_int(50000,99999).'.'.$extension;
        Image::make($image)->save(public_path('uploads/categories/'.$file_name));
        Category::insert([
            'category_name'=>$request->category_name,
            'category_image'=>$file_name,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('success', 'New Category Aded!');
    }
    function delete_category($id){
        Category::find($id)->delete();
        return back()->with('trashed', 'Category Moved to Trash!');
    }
    function category_trash(){
        $categories = Category::onlyTrashed()->get();
        return view('admin.Category.trash',[
            'categories'=>$categories
        ]);
    }
    function permanent_delete_category($id){
        $file = Category::onlyTrashed()->find($id);
        $delete_from = public_path('uploads/categories/'.$file->category_image);
        unlink($delete_from);
        Category::onlyTrashed()->find($id)->forceDelete();
        return back()->with('deleted','Permanently Deleted!');
    }
    function restore_category($id){
        Category::onlyTrashed()->find($id)->restore();
        return back()->with('restored', 'Restored!');
    }
    function checked_delete(Request $request){
        $request->validate([
            'category_id'=>'required',
        ]);
        foreach($request->category_id as $category){
            Category::find($category)->delete();
        }
        return back()->with('checked_trashed', 'Checked are move to Trashed!');
    }
    function checked_cat_action(Request $request){
        $request->validate([
            'category_id'=>'required',
        ]);
        if($request->action_checked==1){
            foreach($request->category_id as $category){
                Category::onlyTrashed()->find($category)->restore();
            }
            return back()->with('checked_restored', 'Checked are Restored!');
        }
        else{
            foreach($request->category_id as $category){
            $cat = Category::onlyTrashed()->find($category);
            $delete_from = public_path('uploads/categories/'.$cat->category_image);
            unlink($delete_from);
                Category::onlyTrashed()->find($category)->forceDelete();
            }
            return back()->with('checked_deleted', 'Checked are Deleted!');
        }
    }

}

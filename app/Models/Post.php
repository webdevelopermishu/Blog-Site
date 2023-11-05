<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded = ['$id'];
    function relate_to_cate(){
        return $this->belongsTo(Category::class, 'category_id');
    }
    function relate_to_auth(){
        return $this->belongsTo(Author::class, 'author_id');
    }
}

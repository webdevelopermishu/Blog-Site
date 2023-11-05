<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    function relate_to_author(){
        return $this->belongsTo(Author::class, 'author_id');
    }
    function replies(){
        return $this->hasMany(Comment::class,'parent_id', 'id');
    }
}

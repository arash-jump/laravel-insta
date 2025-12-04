<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function like(){
        return $this->hasMany(Like::class);
    }

    public function category(){
        return $this->belongsToMany(Category::class, 'category_post');
    }

    public function comment(){
        return $this->hasMany(Comment::class);
    }

    use SoftDeletes;
}

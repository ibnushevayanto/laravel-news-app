<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Comment;

class BlogPosts extends Model
{
    protected $fillable = ['title', 'content'];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}

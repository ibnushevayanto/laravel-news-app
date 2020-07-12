<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\BlogPosts;

class LogAktivity extends Model
{
    protected $fillable = ['user_id', 'content', 'blog_post_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function blogPost()
    {
        return $this->belongsTo(BlogPosts::class, 'blog_post_id', 'id');
    }
}

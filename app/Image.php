<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\BlogPosts;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    protected $fillable = ['path', 'blog_post_id'];

    public function blogpost()
    {
        return $this->belongsTo(BlogPosts::class, 'blog_post_id', 'id');
    }

    public function url()
    {
        return Storage::url($this->path);
    }
}

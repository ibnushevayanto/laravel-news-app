<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\BlogPosts;

class Tag extends Model
{
    public function blogPosts()
    {
        // * Penjelasan Parameter Check Pada BlogPosts.php
        return $this->belongsToMany(BlogPosts::class, 'blog_post_tag', 'tag_id', 'blog_post_id', 'id', 'id')->as('tagged');
    }
}

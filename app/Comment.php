<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\BlogPosts;

class Comment extends Model
{
    /*
        ? Nama Function Sesuaikan Dengan ForeignKey | blogPost = blog_post_id |
    */
    public function blogPost()
    {
        /*
            ! Jika Foreign Key Dengan Function Tidak Ingin Sama Gunakan Parameter Kedua
            ? $this->belongsTo(BlogPosts::class, 'foreign_key')

            ! Jika Primary Key Dari BlogPosts Bukan ID
            ? $this->belongsTo(BlogPosts::class, 'foreign_key', 'primary_key')
        */

        return $this->belongsTo(BlogPosts::class);
    }
}

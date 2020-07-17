<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\BlogPosts;
use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{

    use SoftDeletes;

    /*
        ? Nama Function Sesuaikan Dengan ForeignKey | Example Pada Nama FUnction Dibawah Ini blogPost = blog_post_id |
    */
    public function blogPost()
    {
        /*
            ! Jika Foreign Key Dengan Function Tidak Ingin Sama Gunakan Parameter Kedua
            ? $this->belongsTo(BlogPosts::class, 'foreign_key')

            ! Jika Primary Key Dari BlogPosts Bukan ID
            ? $this->belongsTo(BlogPosts::class, 'foreign_key', 'primary_key')
        */

        return $this->belongsTo(BlogPosts::class, 'blog_post_id', 'id');
    }

    public function scopeLatest(Builder $query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public static function boot()
    {
        parent::boot();
        // static::addGlobalScope(new LatestScope);
    }
}

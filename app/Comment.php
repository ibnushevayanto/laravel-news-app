<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\BlogPosts;
use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\LogAktivity;
use App\Traits\Taggable;

class Comment extends Model
{

    use SoftDeletes, Taggable;

    protected $fillable = ['content', 'blog_post_id', 'user_id'];
    protected $hidden = ['deleted_at', 'user_id', 'comment_for_type', 'created_at', 'updated_at', 'comment_for_id'];

    /*
        ? Nama Function Sesuaikan Dengan ForeignKey | Example Pada Nama FUnction Dibawah Ini blogPost = blog_post_id |
    */
    public function comment()
    {
        /*
            ! Jika Foreign Key Dengan Function Tidak Ingin Sama Gunakan Parameter Kedua
            ? $this->belongsTo(BlogPosts::class, 'foreign_key')

            ! Jika Primary Key Dari BlogPosts Bukan ID
            ? $this->belongsTo(BlogPosts::class, 'foreign_key', 'primary_key')
        */

        // ! return $this->belongsTo(BlogPosts::class, 'blog_post_id', 'id');

        // * Polymorph One To Many

        // * Parameter Pertama Nama Dari Polymorphnya
        // * Parameter Kedua Nama Dari Polymorph type nya
        // * Parameter Ketiga Nama Dari Polymorph id nya
        // * Parameter Keempat adalah PrimaryKey Table

        return $this->morphTo('comment_for', 'comment_for_type', 'comment_for_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function scopeLatest(Builder $query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public static function boot()
    {
        parent::boot();
        // static::addGlobalScope(new LatestScope);

        static::created(function (Comment $comment) {
            Cache::tags(['blog-post'])->flush();

            if (Auth::check()) {
                $logAktivity = new LogAktivity;
                $logAktivity->content = 'Menambahkan Komentar ' . $comment->content;
                $logAktivity->user_id = Auth::id();
                $logAktivity->blog_post_id = $comment->blog_post_id;

                $logAktivity->save();
            }
        });
    }
}

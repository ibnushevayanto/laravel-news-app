<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Comment;
use Illuminate\Support\Facades\Auth;
use App\LogAktivity;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPosts extends Model
{

    use SoftDeletes;

    protected $fillable = ['title', 'content'];

    public function comments()
    {
        return $this->hasMany(Comment::class, 'blog_post_id', 'id');
    }

    public function log_aktivities()
    {
        return $this->hasMany(LogAktivity::class, 'blog_post_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /* 
        * Model Event Listener 
        * Event Yang Bisa Digunakan Bisa Dicheck Disini Semua https://laravel-news.com/laravel-model-events-getting-started
    */
    public static function boot()
    {
        parent::boot();

        static::updated(function (BlogPosts $blogpost) {
            if (Auth::check()) {
                $logAktivity = new LogAktivity;

                $logAktivity->content = 'Mengubah Blogpost ' . $blogpost->title;
                $logAktivity->user_id = Auth::id();
                $logAktivity->blog_post_id = $blogpost->id;

                $logAktivity->save();
            }
        });

        static::created(function (BlogPosts $blogpost) {
            if (Auth::check()) {
                $logAktivity = new LogAktivity;

                $logAktivity->content = 'Menambah Blogpost ' . $blogpost->title;
                $logAktivity->user_id = Auth::id();
                $logAktivity->blog_post_id = $blogpost->id;

                $logAktivity->save();
            }
        });

        static::deleted(function (BlogPosts $blogpost) {
            if (Auth::check()) {
                $logAktivity = new LogAktivity;

                $logAktivity->content = 'Menghapus Blogpost ' . $blogpost->title;
                $logAktivity->user_id = Auth::id();
                $logAktivity->blog_post_id = $blogpost->id;

                $logAktivity->save();
            }

            $blogpost->comments()->delete();
        });

        static::restored(function (BlogPosts $blogpost) {

            if (Auth::check()) {
                $logAktivity = new LogAktivity;

                $logAktivity->content = 'Menambah Blogpost ' . $blogpost->title;
                $logAktivity->user_id = Auth::id();
                $logAktivity->blog_post_id = $blogpost->id;

                $logAktivity->save();
            }

            $blogpost->comments()->restore();
        });
    }
}

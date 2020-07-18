<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Comment;
use Illuminate\Support\Facades\Auth;
use App\LogAktivity;
use App\Scopes\LatestScope;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPosts extends Model
{

    use SoftDeletes;

    protected $fillable = ['title', 'content', 'user_id'];

    public function comments()
    {
        // * Cara kedua menggunakan local query scope pada child relation
        return $this->hasMany(Comment::class, 'blog_post_id', 'id')->latest();
    }

    public function log_aktivities()
    {
        return $this->hasMany(LogAktivity::class, 'blog_post_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // * Cara membuat local query scopes

    // ? Cara menggunakan local query scopes check di BlogPostsController method index()

    public function scopeLatest(Builder $query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeMostCommented(Builder $query)
    {
        return $query->withCount('comments as komentar')->orderBy('komentar', 'desc');
    }

    /* 
        * Model Event Listener 
        * Event Yang Bisa Digunakan Bisa Dicheck Disini Semua https://laravel-news.com/laravel-model-events-getting-started
    */
    public static function boot()
    {
        parent::boot();

        // * Cara Menggunakan Query Global Scope
        // ! static::addGlobalScope(new LatestScope);

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

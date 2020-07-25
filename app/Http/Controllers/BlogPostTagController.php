<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Support\Facades\Cache;

class BlogPostTagController extends Controller
{
    public function index($tagid)
    {
        $tag =  Cache::tags(['blog-post'])->remember("blogpost-tag-{$tagid}", 600, function () use ($tagid) {
            return Tag::with(['blogposts' => function ($query) {
                $query->latest()->withCount(['comments as jumlah_komentar'])->with(['user', 'tags']);
            }])->find($tagid);
        });

        $most_commented = Cache::tags(['blog-post'])->remember("blogpost-most-commented-tag-{$tagid}", 600, function () use ($tagid) {
            return Tag::with(['blogposts' => function ($query) {
                $query->mostCommented()->take(5)->get();
            }])->find($tagid);
        });

        $all_tags = Tag::all();

        return view('BlogPost.Tag.daftarblogpost', ['tag' => $tag, 'most_commented' => $most_commented, 'all_tags' => $all_tags]);
    }
}

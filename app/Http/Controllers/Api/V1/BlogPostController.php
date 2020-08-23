<?php

namespace App\Http\Controllers\Api\V1;

use App\BlogPosts;
use App\Http\Controllers\Controller;
use App\Http\Resources\BlogPost as BlogPostResource;
use App\Tag;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    public function getBlogPost($tag = null)
    {
        if ($tag != null) {
            $getBlopostByTag = Tag::with(['blogposts'])->find($tag);
            $getBlogpostFromTag = $getBlopostByTag->blogposts->pluck('id')->toArray();
            $data = BlogPosts::whereIn('id', $getBlogpostFromTag)->paginate(12);
        } else {
            $data = BlogPosts::paginate(12);
        }

        return BlogPostResource::collection($data);
    }
}

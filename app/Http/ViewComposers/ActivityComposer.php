<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;
use App\User;

// * Cara membuat Blade View Composer

class ActivityComposer
{
    // * Harus dalam function compose dan parameternya seperti dibawah ini
    public function compose(View $view)
    {
        $mostUserWrittenBlogPost = Cache::tags(['blog-post'])->remember('most-user-written-blog-post', 600, function () {
            return User::mostWrittenBlog()->take(5)->get();
        });

        $mostActiveUserLastMonth = Cache::tags(['blog-post'])->remember('most-active-user-last-month', 600, function () {
            return User::mostActiveUserLastMonth()->take(5)->get();
        });

        // * Parameter pertama adalah nama parameter sedangkan parameter kedua adalah isi
        // * Kode dibawah sama seperti ini view('blog.index', ['most_user_written_blogpost' => $mostUserWrittenBlogPost, ...])
        $view->with('most_user_written_blogpost', $mostUserWrittenBlogPost);
        $view->with('most_active_user_last_month', $mostActiveUserLastMonth);
    }
    // * Cara menggunakannya check di AppServiceProvider.php
}

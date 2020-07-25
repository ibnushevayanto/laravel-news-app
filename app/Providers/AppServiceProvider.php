<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // * Parameter pertama adalah lokasinya penggunaanya sama seperti method view()
        // * Parameter kedua adalaha nama component yang kita inginkan
        Blade::component('Components.badge', 'badge');
        Blade::component('Components.date', 'date-upload');
        Blade::component('Components.datacard', 'data-card');
        Blade::component('Components.tags', 'data-tags');
        Blade::component('Components.BlogPost.blogpostslist', 'blogposts-list');
        Blade::component('Components.BlogPost.blogpost', 'blogpost');
        Blade::component('Components.BlogPost.komentarblogpost', 'komentar-blogpost');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

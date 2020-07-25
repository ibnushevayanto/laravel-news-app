<?php

namespace App\Providers;

use App\Http\ViewComposers\ActivityComposer;
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

        // * Cara Menggunakan Views Composer
        // * Parameter pertama adalah direktori dari file views yang diinginkan auto load
        // * Parameter kedua adalah Class Composer yang ingin digunakan
        view()->composer('BlogPost.daftarblogpost', ActivityComposer::class);
        view()->composer('BlogPost.Tag.daftarblogpost', ActivityComposer::class);
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

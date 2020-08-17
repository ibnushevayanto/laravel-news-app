<?php

namespace App\Providers;

use App\Http\ViewComposers\ActivityComposer;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use App\Http\Resources\Comment as CommentResource;
use Illuminate\Http\Resources\Json\JsonResource;

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
        Blade::component('Components.Komentar.list_komentar', 'list-komentar-blogpost');

        // * Cara Menggunakan Views Composer
        // * Parameter pertama adalah direktori dari file views yang diinginkan auto load
        // * Parameter kedua adalah Class Composer yang ingin digunakan

        view()->composer(['BlogPost.daftarblogpost', 'BlogPost.Tag.daftarblogpost'], ActivityComposer::class);

        // * Jika ingin berlaku pada semua views
        // ! view()->composer('*', ActivityComposer::class);



        // * Cara agar tidak memunculkan default response pada resource

        // ? Jika Ingin Satu Resource Aja
        // ! CommentResource::withoutWrapping();

        // ? Jika Ingin Semua Resource
        JsonResource::withoutWrapping();
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

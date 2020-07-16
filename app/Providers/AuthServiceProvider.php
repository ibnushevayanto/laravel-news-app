<?php

namespace App\Providers;

use App\BlogPosts;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        BlogPosts::class => 'App\Policies\BlogPostPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /* 
            * Cara Membuat Gate
            ! Gate::define('update-post', function ($user, $post) {
            ! // Syntax
            ! });
            ? Gate::define harus menghasilkan nilai boolean
            ? Pada parameter pertama dalam define adalah nama gate tersebut
            ? Pada paramter kedua dalam define adalah clojure 
            ? Dan pada parameter pertama clojure sudah automatis mendapatkan data dari authentikasi login
        */

        /*

            Gate::define('update-post', function ($user, $post) {
                return $user->id == $post->user_id;
            });

            Gate::define('delete-post', function ($user, $post) {
                return $user->id == $post->user_id;
            });

        */

        // * Cara Menggunakan Policy

        // * Cara Pertama, Dengan Mendefine Satu Satu
        /* 
            Gate::define('blogpost.update', 'App\Policies\BlogPostPolicy@update');
            Gate::define('blogpost.delete', 'App\Policies\BlogPostPolicy@delete');
        */

        // * Cara Kedua, Dengan Mendefine Sekaligu

        // Gate::resource('blogpost', 'App\Policies\BlogPostPolicy');

        // * Cara Ketiga Dengan Mendaftarkan Policy
        // ! Check Line 15

        /* 
            * Gate::before()
            ? Gate::before adalah method yang dipanggil sebelum gate di inisialisasi
            ? Parameter hanya satu clojure
            ? Clojure paramater sama seperti Gate::define
        */

        Gate::define('page.secret', function ($user) {
            return $user->is_admin;
        });

        Gate::before(function ($user, $ability) {
            if ($user->is_admin && in_array($ability, ['delete'])) {
                return true;
            }
        });

        /* 
            ? Kebalikan dari Gate::before, Gate::after adalah event saat gate berhasil dicheck
            ? $result disini mengarah pada hasil dari Gate::define()
        */

        /* 
            Gate::after(function ($user, $ability, $result) {
                if ($user->is_admin) {
                    return true;
                }
            });
        */
    }
}

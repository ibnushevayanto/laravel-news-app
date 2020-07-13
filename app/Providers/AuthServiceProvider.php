<?php

namespace App\Providers;

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
        // 'App\Model' => 'App\Policies\ModelPolicy',
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

        Gate::define('update-post', function ($user, $post) {
            return $user->id == $post->user_id;
        });
    }
}

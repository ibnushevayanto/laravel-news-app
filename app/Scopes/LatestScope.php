<?php

// * Cara Membuat Query Global Scope
// * Cara Menggunakan Query Scope Ini Check Pada App/BlogPosts.php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class LatestScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->orderBy('created_at', 'desc');

        // ? Bisa Juga Menggunakan Kode Dibawah Ini Tetapi Hanya Column Tertentu Saja
        // $builder->orderBy($model::CREATED_AT, 'desc');

    }
}

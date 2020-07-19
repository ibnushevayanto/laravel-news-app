<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class AdminScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if (Auth::check() && Auth::user()->is_admin) {

            // $builder->withTrashed();

            // ? Jika Tidak Ingin Menggunakan Global Scope Yang Lain 
            $builder->withoutGlobalScope('Illuminate\Database\Eloquent\SoftDeletingScope');
        }
    }
}

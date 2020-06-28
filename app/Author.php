<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Profile;

class Author extends Model
{
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
}

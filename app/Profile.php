<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Author;

class Profile extends Model
{
    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}

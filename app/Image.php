<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\BlogPosts;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    protected $fillable = ['path'];

    public function image()
    {
        // * Parameter Pertama Nama Dari Polymorphnya
        // * Parameter Kedua Nama Dari Polymorph type nya
        // * Parameter Ketiga Nama Dari Polymorph id nya
        // * Parameter Keempat adalah PrimaryKey Table

        return $this->morphTo('image_for', 'image_for_type', 'image_for_id', 'id');
    }

    public function url()
    {
        return Storage::url($this->path);
    }
}

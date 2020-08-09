<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\BlogPosts;

class Tag extends Model
{

    protected $fillable = ['name'];

    public function blogposts()
    {
        // ? Relasi Many To Many

        // * Penjelasan Parameter Check Pada BlogPosts.php
        // ! return $this->belongsToMany(BlogPosts::class, 'blog_post_tag', 'tag_id', 'blog_post_id', 'id', 'id')->as('tagged');

        // ? Morph Many To Many

        // * Parameter Pertama Adalah Class Yang Akan Dihubungkan
        // * Parameter Kedua Adalah Nama Morphnya
        // * Parameter Ketiga Adalah Nama Table Pivotnya
        // * Parameter Keempat Adalah Nama Column ForeignKeynya, Case Disini Adalah tag_id yang mana terhubung dengan tags table
        // * Parameter Kelima Adalah Nama Column Id Untuk Pivotnya
        // * Parameter Keenam Adalah Column Primay Key Dari Parent Yaitu Table tags
        // * Parameter Ketujuh Adalah Column Primay Key Dari Table Pivot Yaitu Table taggable

        return $this->morphedByMany(BlogPosts::class, 'tag_for', 'taggables', 'tag_id', 'tag_for_id', 'id', 'id');
    }

    public function comments()
    {
        return $this->morphedByMany(Comment::class, 'tag_for', 'taggables', 'tag_id', 'tag_for_id', 'id', 'id');
    }
}

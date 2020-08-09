<?php

namespace App\Traits;

use App\Tag;

/**
 * 
 */
trait Taggable
{
    // * Membuat Function Yang Terhubung Dengan Event Pada Model
    protected static function bootTaggable()
    {
        static::updating(function ($model) {
            $model->tags()->sync(static::findTagInContent($model->content));
        });

        static::created(function ($model) {
            $model->tags()->sync(static::findTagInContent($model->content));
        });
    }

    // * Cara Instansiasi Model Many To Many

    public function tags()
    {
        // ? Relasi Many To Many

        // * Parameter Pertama Adalah Class Terkait
        // * Parameter Kedua Adalah Nama Table Pivot
        // * Parameter Ketiga Adalah Key Kita Disana, Sebagai Contoh Karena Ini Di Model BlogPost Maka Keynya Adalah blog_post_id
        // * Parameter Keempat Adalah foregin key yang lain yang terhubung juga
        // * Parameter Kelima Adalah PrimaryKey Dari Table Kita, Karena Ini Di Table blog_posts maka Primarynya adalah id
        // * Parameter Keenam Adalah PrimaryKey Dari Table Terkait
        // * as('tagged') untuk mengaliaskan pivot

        // ! return $this->belongsToMany(Tag::class, 'blog_post_tag', 'blog_post_id', 'tag_id', 'id', 'id')->withTimestamps()->as('tagged');

        // ? Polymorph Many To Many

        // * Parameter Pertama Adalah Class Yang Akan Dihubungkan
        // * Parameter Kedua Adalah Nama Morphnya
        // * Parameter Ketiga Adalah Nama Table Pivotnya
        // * Parameter Keempat Adalah Nama Column ForeignKey yang terhubung dengan PrimaryKey Di Table Ini
        // * Parameter Kelima Adalah Nama Column ForeignKey yang terhubung dengan Primary Key Yang Ingin Dituju Case Disini adala Table Tags
        // * Parameter Keenam Adalah Column Primay Key Dari Parent Dari Table Ini
        // * Parameter Ketujuh Adalah Column Primay Key Dari Table Tags

        return $this->morphToMany(Tag::class, 'tag_for', 'taggables', 'tag_for_id', 'tag_id', 'id', 'id')->withTimestamps()->as('tagged');
    }

    private static function findTagInContent($content)
    {
        preg_match_all("/@([^@]+)@/m", $content, $tags);
        return Tag::whereIn('name', $tags[1] ?? [])->get();
    }
}

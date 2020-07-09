<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Author;
use App\Profile;
use Faker\Generator as Faker;

$factory->define(Author::class, function (Faker $faker) {
    return [
        //
    ];
});

/* 
    * +++ EVENT YANG ADA DI MODEL FACTORY +++
*/

/*
    ? afterCreating() event saat factory berhasil disimpan di database
*/

$factory->afterCreating(Author::class, function ($author, $faker) {
    $author->profile()->save(factory(Profile::class)->make());
});

/*
    ? afterMaking() event saat factory berhasil dibuat tetapi belum disimpan di database
*/

/*
    ! $factory->afterMaking(Author::class, function ($author, $faker) {
    !     $author->profile()->save(factory(Profile::class)->make());
    ! });
*/
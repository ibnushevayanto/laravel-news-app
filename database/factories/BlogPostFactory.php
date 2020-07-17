<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\BlogPosts;
use Faker\Generator as Faker;

$factory->define(BlogPosts::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(10),
        'content' => $faker->paragraphs(3, true),
        'created_at' => $faker->dateTimeBetween('-3 Months')
    ];
});

$factory->state(BlogPosts::class, 'new-blogpost-test', function (Faker $faker) {
    return [
        'title' => 'New Title',
        'content' => 'Content of the blog post'
    ];
});

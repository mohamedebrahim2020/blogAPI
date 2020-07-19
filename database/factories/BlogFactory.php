<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Blog;
use Faker\Generator as Faker;

$factory->define(Blog::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'content' => $faker->name,
        'image' => 'files/y3pqHMz7zQtSCjT7G3iIAs6xkeTBn5c16Ai7pFzF.jpg',
    ];
});

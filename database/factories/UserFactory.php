<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
|  
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
   
    return [
        
        'first_name' => $faker->name,
        'second_name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'image' => 'files/y3pqHMz7zQtSCjT7G3iIAs6xkeTBn5c16Ai7pFzF.jpg',
        'email_verified_at' => now(),
        // 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'password' => '123456789M',
        'remember_token' => Str::random(10),
    ];
});

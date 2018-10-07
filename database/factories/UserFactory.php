<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Triskelion\Models\User::class, function (Faker $faker) {
    return [
        'code' => str_random(32),
        'name' => $faker->name,
        'mobile' => random_int(10000000000, 19999999999),
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'active' => random_int(0, 1),
        'remember_token' => str_random(10),
    ];
});

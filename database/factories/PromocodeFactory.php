<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Promocode;
use Illuminate\Support\Str;
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

$factory->define(Promocode::class, function (Faker $faker) {

    $name = array_rand(
        str_split(config('app.promocodes_alphabet')),
        config('app.max_promocodes_length')
    );

    return [
        'value' => $faker->numberBetween(0,100),
        'max_use_count' => $faker->numberBetween(1,100),
        'use_count' => 0,
        'name' => $name,
    ];
});

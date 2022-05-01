<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Proveidor;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(Proveidor::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->name,
        'city' => $faker->word(5),
        'speciality' => $faker->word(5)
    ];
});

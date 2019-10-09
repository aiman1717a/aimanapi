<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Employees;
use Faker\Generator as Faker;

$factory->define(Employees::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'password' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'type' => $faker->randomElement(['Admin', 'Editors', 'Moderators']),
        'status' => $faker->randomElement(['Active', 'InActive']),
    ];
});

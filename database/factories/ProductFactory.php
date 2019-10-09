<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Employees;
use App\Model;
use App\Listings;
use Faker\Generator as Faker;

$factory->define(Listings::class, function (Faker $faker) {
    $admin = Employees::all()->pluck('id')->toArray();
    return [
        'name' => $faker->name,
        'price' => $faker->numberBetween(1, 100),
        'description' => $faker->text(200),
        'showcase' => $faker->randomElement(['Active', 'InActive']),
        'per_unit_qty' => $faker->numberBetween(1, 10),
        'admin_id' =>$faker->randomElement($admin),
    ];
});

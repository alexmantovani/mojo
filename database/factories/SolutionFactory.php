<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Solution;
use Faker\Generator as Faker;

$factory->define(Solution::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1,10),
        'description' => $faker->text(),
    ];
});

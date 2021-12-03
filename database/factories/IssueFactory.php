<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Issue;
use Faker\Generator as Faker;

$factory->define(Issue::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1,10),
//        'status_id' => 1,
        'title' => $faker->sentence(),
        'description' => $faker->text(),
    ];
});

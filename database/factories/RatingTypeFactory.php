<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\RatingType::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'description' => $faker->sentence
    ];
});

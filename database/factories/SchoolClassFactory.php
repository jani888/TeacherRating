<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\SchoolClass::class, function (Faker $faker) {
    return [
        'name' => $faker->countryCode,
        'can_vote' => true
    ];
});

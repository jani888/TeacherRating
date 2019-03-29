<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Group::class, function (Faker $faker) {
    return [
        'name' => $faker->countryCode,
        'teacher_id' => factory(\App\Models\Teacher::class)->create()->id
    ];
});

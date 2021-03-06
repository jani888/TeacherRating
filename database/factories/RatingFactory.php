<?php

use App\User;
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

$factory->define(\App\Models\Rating::class, function (Faker $faker) {
    return [
        'value' => rand(0, 9),
        'rating_type_id' => rand(1, 9),
        'teacher_id' => rand(1, 9),
        'school_class_id' => rand(1, 9),
    ];
});

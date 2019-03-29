<?php

use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);

        $groups = factory(\App\Models\Group::class)->times(5)->create();

        User::first()->groups()->sync($groups);

        $rating_types = factory(\App\Models\RatingType::class)->times(10)->create();
    }
}

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
        $this->call(AdminsTableSeeder::class);

        $classes = factory(\App\Models\SchoolClass::class)->times(5)->create();

        User::create([
            'name' => 'admin',
            'password' => bcrypt('admin'),
            'school_class_id' => $classes->random()->id
        ]);

        $groups = factory(\App\Models\Group::class)->times(5)->create();


        $groups->each(function ($group){
            $teachers = factory(\App\Models\Teacher::class)->times(rand(1, 4))->create();
            $group->teachers()->sync($teachers);
        });

        User::first()->groups()->sync($groups);

        $rating_types = factory(\App\Models\RatingType::class)->times(10)->create();

    }
}

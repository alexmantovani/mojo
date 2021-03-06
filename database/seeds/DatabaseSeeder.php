<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class DatabaseSeeder extends Seeder
{
    /**
    * Seed the application's database.
    *
    * @return void
    */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(\App\User::class, 10)->create()->each(function ($u) {
            $u->save();
        });

        $this->call(StatusSeeder::class);
        $this->call(IssueSeeder::class);
        $this->call(TagSeeder::class);
    }
}

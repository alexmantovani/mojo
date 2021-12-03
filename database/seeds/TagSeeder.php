<?php

use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        factory(\App\Tag::class, 30)->create()->each(function ($u) {
            $u->save();
        });
    }
}
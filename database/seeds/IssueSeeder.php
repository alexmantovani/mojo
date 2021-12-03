<?php

use Illuminate\Database\Seeder;

class IssueSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        factory(\App\Issue::class, 100)->create()->each(function ($u) {
            $u->save();
        });
    }
}

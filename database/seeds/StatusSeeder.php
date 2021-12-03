<?php

use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Status::create([ 'name' => 'Unresolved', 'type' => 'warning' ]);   // 1
        App\Status::create([ 'name' => 'Resolved', 'type' => 'success' ]);// 2
        App\Status::create([ 'name' => 'Urgent', 'type' => 'danger' ]);    // 3
    }
}

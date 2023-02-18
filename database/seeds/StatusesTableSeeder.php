<?php

use Illuminate\Database\Seeder;
use App\Status;

class StatusesTableSeeder extends Seeder {
    public function run()
    {
        DB::table('statuses')->insert([
            ['title' => 'Active'],
            ['title' => 'Coming Soon'],
            ['title' => 'Maintenance']
        ]);
    }
}

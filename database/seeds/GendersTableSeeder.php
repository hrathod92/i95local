<?php

use Illuminate\Database\Seeder;

class GendersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genders')->insert([
            ['name' => 'Male'],
            ['name' => 'Female'],
            ['name' => 'Do not wish to disclose']
        ]);
    }
}

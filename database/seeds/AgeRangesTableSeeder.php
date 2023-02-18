<?php

use Illuminate\Database\Seeder;

class AgeRangesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('age_ranges')->insert([
            ['range' => '< 40'],
            ['range' => '40-49'],
            ['range' => '50-59'],
            ['range' => '60-69'],
            ['range' => '70-79'],
            ['range' => '80+']
        ]);
    }
}

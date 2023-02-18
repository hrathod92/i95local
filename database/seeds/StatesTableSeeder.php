<?php

use Illuminate\Database\Seeder;
use App\Helpers\FileSeeder;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table='states';
		$file=realpath(dirname(__FILE__)).'/files/'. $table .'.json';
		FileSeeder::seed_files($table, $file);
    }
}

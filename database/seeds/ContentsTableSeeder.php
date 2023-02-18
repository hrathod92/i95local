<?php

use Illuminate\Database\Seeder;
use App\Helpers\FileSeeder;

class ContentsTableSeeder extends Seeder {

    public function run()
    {
      $table='contents';
      $file=realpath(dirname(__FILE__)).'/files/'. $table .'.json';
      FileSeeder::seed_files($table, $file);
    }

}

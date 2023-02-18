<?php

use Illuminate\Database\Seeder;
use App\Helpers\FileSeeder;

class RegionsTableSeeder extends Seeder {

    public function run()
    {
      $table='regions';
      $file=realpath(dirname(__FILE__)).'/files/'. $table .'.json';
      echo $file;
      FileSeeder::seed_files($table, $file);
    }

}

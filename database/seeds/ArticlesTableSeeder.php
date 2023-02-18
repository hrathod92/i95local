<?php

use Illuminate\Database\Seeder;
use App\Helpers\FileSeeder;

class ArticlesTableSeeder extends Seeder {

    public function run()
    {
      $table='articles';
      $file=realpath(dirname(__FILE__)).'/files/'. $table .'.json';
      FileSeeder::seed_files($table, $file);
    }

}

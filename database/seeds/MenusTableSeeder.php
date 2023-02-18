<?php

use Illuminate\Database\Seeder;
use App\Helpers\FileSeeder;

class MenusTableSeeder extends Seeder {

    public function run()
    {
      $table='menus';
      $file=realpath(dirname(__FILE__)).'/files/'. $table .'.json';
      FileSeeder::seed_files($table, $file);
    }

}

<?php

use Illuminate\Database\Seeder;
use App\Helpers\FileSeeder;

class SettingsTableSeeder extends Seeder {

    public function run()
    {
      $table='settings';
      $file=realpath(dirname(__FILE__)).'/files/'. $table .'.json';
      FileSeeder::seed_files($table, $file);
    }

}

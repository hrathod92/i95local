<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

namespace App\Helpers;

class FileSeeder {

  public static function seed_files($table, $file){
    $json = json_decode(file_get_contents($file));
    if (isset($json)){
      foreach ($json as $entries) {
        $row=[];
        foreach ($entries as $key => $val) {
          $row[$key]=$val;
        }
        \DB::table($table)->insert([$row]);
        var_dump($row);
      }
    }else{
      echo "file not set";
    }
  }
}

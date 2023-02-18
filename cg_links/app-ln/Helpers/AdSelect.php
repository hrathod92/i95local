<?php

namespace App\Helpers;

use App\Ad;

class AdSelect {
  

  public static function get( $ad_type_id, $category_id=0 ) {
    
     $ad_type = $ad_type_id;
      if($ad_type == 0 || $ad_type == 10 || $ad_type == 20 || $ad_type == 30 || $ad_type == 50 || $ad_type == 60 || $ad_type == 70 || $ad_type == 80){
        $ros_type = 40;
      }
      if($ad_type == 1 || $ad_type == 2 || $ad_type == 11 || $ad_type == 31 || $ad_type == 51 || $ad_type == 61 || $ad_type == 71 || $ad_type == 81){
        $ros_type = 41;
      }
      if($ad_type == 5 || $ad_type == 6 || $ad_type == 7 || $ad_type == 15 || $ad_type == 16 || $ad_type == 25 || $ad_type == 26 || $ad_type == 35 || $ad_type == 36 || $ad_type == 37 || $ad_type == 55 || $ad_type == 56 || $ad_type == 57 || $ad_type == 65 || $ad_type == 66 || $ad_type == 67 || $ad_type == 75 || $ad_type == 76 || $ad_type == 77 || $ad_type == 85 || $ad_type == 86 || $ad_type == 87){
        $ros_type = 45;
      }
    
    if($ad_type_id < 40 || $ad_type_id > 49 ){
      if ( $category_id == 0 ) {
        $ads = Ad::where( 'status_id', 0 )
          ->where( 'publish_status_id', 1 )
          ->where('publish_end_at', '>=', \Carbon\Carbon::now())
          ->where( 'ad_type_id', $ad_type_id )
          ->orderBy('random_weight', 'DESC')
          ->get();
      } else {
        // Narrow query by category for articles.
        $ads = Ad::where( 'status_id', 0 )
          ->where( 'publish_status_id', 1 )
          ->category( $category_id )
          ->where('publish_end_at', '>=', \Carbon\Carbon::now())
          ->where( 'ad_type_id', $ad_type_id )
          ->orderBy('random_weight', 'DESC')
          ->get();  
      }
      
     if ( $ads->count() > 0 ) {
        $weight = $ads->sum('random_weight');
        $ros_total = Ad::where( 'status_id', 0 )->where('publish_end_at', '>=', \Carbon\Carbon::now())->where( 'ad_type_id', $ros_type )->orderByRaw("RAND()")->count(); 
        if($weight < 100 && $ros_total > 0){
          while($weight < 100 && $ros_total > 0){
            $match = 0;
            $temp = Ad::where( 'status_id', 0 )->where('publish_end_at', '>=', \Carbon\Carbon::now())->where( 'ad_type_id', $ros_type )->orderByRaw("RAND()")->first();
              foreach($ads as $ad){
                if($ad->id == $temp->id){
                  $match ++;
                }
              }
              if($match == 0){
                $weight = $weight + $temp->random_weight; 
                $ads->push($temp);
              }
            $ros_total = $ros_total - 1;
          }
        }
        if($weight > 100){
          $cycle = 0;
          $filter = collect(new Ad);
          foreach($ads as $ad){
            if($cycle < 100){
              $filter->push($ad);
              $cycle = $cycle + $ad->random_weight;
            }
          }
          $ads = $filter;
        }
      }else{
        $ads = Ad::where( 'status_id', 0 )->where('publish_end_at', '>=', \Carbon\Carbon::now())->where( 'ad_type_id', $ros_type )->orderByRaw("RAND()")->get(); 
     }    
    }else{
      $ads = Ad::where( 'status_id', 0 )->where('publish_end_at', '>=', \Carbon\Carbon::now())->where( 'ad_type_id', $ros_type )->orderByRaw("RAND()")->get();
    }
       
    $picked = null;
    
    if(count($ads) > 1){
      $total = $ads->sum('random_weight');
      $setval = mt_rand(0, $total);
      $counter = 0;
      $pick = null;
      
      while($counter <= $setval){
        foreach($ads as $data){
          $cnt = 0;
          while($cnt <= $data->random_weight){
            if($counter == $setval){
             $counter++;
             $pick = $data->id; 
            }else{
              $counter++;
            }
            $cnt++;
          }
        }
      }
      $picked = Ad::find($pick); 
    }elseif(count($ads) == 1){
      $picked = $ads[0];
    }else{
      $picked = null;
    }
    if(!empty($picked)){
      if(!empty($picked['ad_url'])){
          if(!preg_match('/http:/', $picked['ad_url']) && !preg_match('/https:/', $picked['ad_url'])){
            $picked['ad_url'] = 'http://'.$picked['ad_url'];
            $picked->save();
          }
        }else{
        $comp = \App\Company::where('id', $picked->company_id)->first();
        if(!empty($comp)){
          if($comp['company_type_id'] == 0){
            if(!empty($comp->contact_us_url)){
              if(!preg_match('/http:/', $comp->contact_us_url) && !preg_match('/https:/', $comp->contact_us_url)){
                $picked['ad_url'] = 'http://'.$comp->contact_us_url;
              }else{
                $picked['ad_url'] = $comp->contact_us_url;
              }
            }else{
              $picked['ad_url'] = "/companies/".$comp->id;
            }
          }else{
            if(!empty($comp->contact_us_url)){
              if(!preg_match('/http:/', $comp->contact_us_url) && !preg_match('/https:/', $comp->contact_us_url)){
                $picked['ad_url'] = 'http://'.$comp->contact_us_url;
              }else{
                $picked['ad_url'] = $comp->contact_us_url;
              }
            }else{
              $picked['ad_url'] = url();
            }
          }
         }
        }
      }
  
    return $picked;
  }
  
}

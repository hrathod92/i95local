<?php

namespace App\Helpers;

class Status {

  public static function checkEvents() {
    $str = 0;
    $events = \App\Event::where('status_id', 0)->get();
     foreach($events as $event){
        if(!empty($event->ends_at)){
          if($event->ends_at < date('Y-m-d')){
              $event->status_id = 1;
              $event->save();
             $str++;
          }
        }else{
          if($event->starts_at < date('Y-m-d')){
              $event->status_id = 1;
              $event->save();
              $str++;
          }
        }
     }      
     return $str;
  }
  
   public static function checkAds() {
    $str = 0;
    $t = \Carbon\Carbon::now();
     
    $ads = \App\Ad::where('status_id', 0)->where('publish_end_at', '<=', $t)->get();
    $count = count($ads); 
     
     if($count > 0){
       foreach($ads as $ad){
         $ad->status_id = 1;
         $ad->save();
       }
     }
     return $count;
  }
}

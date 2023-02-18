<?php

namespace App\Helpers;

class Display {

  public static function dateStd( $dateStr ) {
    return date( 'M d, Y', strtotime( $dateStr ));
  }
  
  public static function dateWithDOW( $dateStr ) {
    return date( 'M d, Y (D)', strtotime( $dateStr ));
  }
  
  public static function timeWithAPM( $timeStr ) {
    return date( 'j:i A', strtotime( $timeStr ));
  }
  
  public static function teaser( $str, $len=200 ) {
    if ( $len > strlen( $str )) $len = strlen( $str );
    $wordLen = strpos( $str, ' ', $len );
    return substr( $str, 0, $wordLen ) . ' ...';
  }
  
  // Helper functions for URL slugs.  
  public static function space_replace($comp_name, $with='') {
    $remove_chars = Array(' ');
    $cln_title = $comp_name;
    $cln_title = str_replace($remove_chars, $with, $comp_name);
    return $cln_title;
  }
  
  public static function dash_replace($comp_name, $with=' ') {
    $remove_chars = Array('-');
    $cln_title = $comp_name;
    $cln_title = str_replace($remove_chars, ' ', $comp_name);
    return $cln_title;
  }
   // Removes unsafe chars from slug " < > # % { } | \ ^ ~ [ ] `, and some other sp chars
  public static function linkify($title){
      $remove_chars = Array('"', "'", ']', '[', '~', '^', '|', '}', '{', '%', '#', '>', '<', str_replace(' ','','\ '), '/', ',', '(', ')', '.'); 
      $link_name = $title;
      $cln_title = str_replace($remove_chars, '', $link_name);
      $cln_title = self::space_replace($cln_title, '-');
      return strtolower($cln_title);
  }    
}

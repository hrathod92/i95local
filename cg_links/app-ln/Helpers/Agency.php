<?php

namespace App\Helpers;

use \App\AgencyCompany;
use \App\Company;

use Illuminate\Database\Eloquent\Collection;

class Agency {

  public static function getClientNames( $id ) {
    $clients = AgencyCompany::where('agency_id', $id)->get();
    $str = null;
    foreach($clients as $client){
        $record = \App\Company::find($client->company_id);
        $str = $str.$record->title.' - ';
    }
    $str = substr($str, 0, -3);
    return $str;
  }
  
  public static function getClientList( $id ) {
    $clients = AgencyCompany::where('agency_id', $id)->get();
    $clientList = new collection();
    foreach($clients as $client){
        $record = \App\Company::find($client->company_id);
        $clientList->push($record);
    }
    $clientList = $clientList->sortBy('title');
    return $clientList;
  }
    
  public static function isAllowed( $id, $company_id ) {
    $clients = AgencyCompany::where('agency_id', $id)->where('company_id', $company_id)->first();
    if(count($clients) > 0){
        return true;   
    }else{
        return false;    
    }
    
  }
  
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\HasPublishStatusHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Company;
use App\Ad;

class AdController extends Controller
{

    use HasPublishStatusHelpers;

    public function __construct()
    {
      $this->middleware('auth', ['except' => 'show']);
    }

    public function index(Request $request)
    {
      $query = Ad::select( 'ads.*', 'ad_types.title AS atitle' )
        ->with( 'ad_type', 'company', 'publish_status', 'status', 'category' )
        ->join( 'ad_types', 'ad_types.id', '=', 'ads.ad_type_id' )
        ->orderBy( 'ad_types.title' );
      $input = $request->all();
      if( isset($input["company_id"]) && $input["company_id"] ) {
        $query->where("company_id", $input["company_id"]);
        $data['company_id'] = $input["company_id"];
      }
      if( isset($input["ad_type_id"]) && $input["ad_type_id"] != -1 ) {
        $query->where("ad_type_id", $input["ad_type_id"]);
        $data['ad_type_id'] = $input["ad_type_id"];
      }
      if( isset($input["category_id"]) && $input["category_id"] != -1 ) {
        $query->where("category_id", $input["category_id"]);
        $data['category_id'] = $input["category_id"];
      }
      if( isset($input["status_id"]) && $input["status_id"] != 0 ) {
        $query->where("status_id", $input["status_id"]);
        $data['status_id'] = $input["status_id"];
      } else {
        $query->where("status_id", 0 );
        $data['status_id'] = 0;       
      }
      $data['items'] = $query->get();
      $data['checked'] = \App\Helpers\Status::checkAds();
      
      return view('ad.index', $data);
    }
  
    public function company( $id=0 )
    {
      //dd(\Auth::user()->role);
      if (\Auth::user()->role != 'admin' ) {
        $id = \Auth::user()->company_id;
        //dd($id);
        $data['items'] = Ad::with( 'ad_type', 'company', 'publish_status', 'status' )
        ->where( 'company_id', $id )
        ->where( 'status_id', 0 )
        ->where(function($query){
            $query->where('ad_type_id', 20)
                  ->orWhere('ad_type_id', 25)
                  ->orWhere('ad_type_id', 26);
        }) 
        ->orderBy('ad_type_id')
        ->get();
      }else{
        $id = \Auth::user()->company_id;
        $data['items'] = Ad::with( 'ad_type', 'company', 'publish_status', 'status' )
        ->where( 'company_id', $id )
        ->orderBy('ad_type_id')
        ->get();
      }
      return view( 'ad.company', $data );
    }

    public function show($slug)
    {
      $data['item'] = Ad::with( 'ad_type' )->where('slug','=', $slug)->first();
      return view('ad.show', $data);
    }
  
    public function view($id)
    {
      $data['item'] = Ad::with( 'ad_type' )->find( $id )->first();
      return view('ad.show', $data);
    }

    public function create()
    {
        $data = [
            'ad' => new Ad(),
        ];
        return view('ad.create', $data);
    }

    public function isValidCompany( $companyId ){
      $user = \Auth::user();
      if( $user->role == "agency" && \App\Helpers\Agency::isAllowed(\Auth::user()->company_id, $companyId)){
        return true;  
      }elseif( $user->role != "admin" && $user->company_id != $companyId ){
        return false;  
      }else{
        return true;  
      } 

    }

    public function store(Request $request)
    {
      $input = \Input::except( ['image','image_delete'] );
      $item  = Ad::create( $input );

        if(!$this->isValidCompany($input["company_id"])){
            return back()->withInput($input)->withErrors(["Not valid company"]);
        }
      
        if(empty($item->title)){
          $item->title = 'Ad-'.$item->id;
        }
      
      $item->slug = \Str::slug($item->title, '-')."-".$item->id;
      
      $item->ad_url = $request->ad_url;
      $file = $request->file( 'image' );
      
      
        if(!empty($file)) {
            $imageName = $item['slug'] . '.' . $request->file('image')->getClientOriginalExtension();
            $destinationPath = base_path() . '/public/data/ads/img';
            $request->file('image')->move($destinationPath, $imageName);
            $item['image'] = $imageName;
        }elseif(!empty($request->image_delete)) {
            $item['image'] = null;
        }



      
      $item->save();
      
        if(empty($item->image)){
          $item->publish_status_id = 0;
          \App\Helpers\Email::newAd($item->company_id);
        }
      
      $item['category_id'] = $request->category_id;
      
      $item->save();

      return redirect( '/ads/' . $item->slug );
    }

    public function edit($slug)
    {
      $data['ad'] = Ad::where('slug', $slug)->first();
      return view('ad.edit', $data);
    }

    public function update(Request $request, $id)
    {
    $input  = \Input::except(['submit', '_token', '_method', 'image','image_delete']);
    $record = Ad::find($id)->first();
      if ( !isset( $input["company_id"] ) || !$this->isValidCompany( $input["company_id"] )) {
          return back()->withInput( $input )->withErrors( ["Not valid company"] );
      }

    foreach ($input AS $key => $value) $record[$key] = $value;

    $file = $request->file('image');
      
      if (!empty($file)) {
        $imageName = $record['slug'] . '.' . $request->file('image')->getClientOriginalExtension();
        $destinationPath = base_path() . '/public/data/ads/img';
        $request->file('image')->move($destinationPath, $imageName);
        $record['image'] = $imageName;
      } elseif (isset($request->image_delete)) {
        $record['image'] = null;
      }
    
      if(empty($record->image)){
        $record->publish_status_id = 0;
      }
    $record->slug = \Str::slug($record->title, '-')."-".$record->id;
    $record->save();
    
    if( \Auth::user()->role == 'agency'){
        return redirect( '/dashboard' );    
    }else{
        return redirect( '/ads/' . $record->slug );    
    }
    
    
    }

    protected function getAds(User $user = null)
    {
        $query = Ad::query();

        if ($user) {
            $query->where('owner_id', $user->id);
        }

        return $query
            ->orderByPublishStatus()
            ->orderBy('slug')
            ->orderBy('type')
            ->get();
    }
  
  public function destroy($id){
    $ads = Ad::find($id)->first();
    $ads->delete();
    
    return redirect('ads');
  }
  
  public function updateSlug(){
    $ads = Ad::all();
    foreach($ads as $ad){
      $ad->slug = \Str::slug($ad->title, '-')."-".$ad->id;
      $ad->save();
    }
    return redirect('ads');
  }
  
  public function updateImageField(){
    $ads = Ad::all();
    foreach ( $ads as $ad ) {
      if ( !empty( $ad->image )) {
        $ad->image2 = $ad->slug . substr( $ad->image, strripos( $ad->image, '.' ));
        $ad->save();
      }
    }
    return redirect('ads');
  }
  
  public function updateImageFile(){
    $ads = Ad::all();
    foreach($ads as $ad){
      if ( !empty($ad->image) && file_exists( public_path() . '/data/ads/img/' . $ad->image ))
      copy( public_path() . '/data/ads/img/' . $ad->image, public_path() . '/data/ads/img3/' . $ad->image2 );
    }
    return redirect('ads');
  }
    
  public function updateAlts(){
      $ads = \App\Ad::all();
      foreach($ads as $ad){
          if(empty($ad->image_alt)){
            $ad->image_alt = $ad->title;
            $ad->save();
          }
      }
      $events = \App\Event::all();
      foreach($events as $ad){
          if(empty($ad->image_alt)){
            $ad->image_alt = $ad->title;
            $ad->save();
          }
      }
      return redirect('/');
  }

}

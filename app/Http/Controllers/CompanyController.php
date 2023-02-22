<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use \App\Company;
use \App\Status;
use \App\Helpers\Display;

class CompanyController extends Controller
{
    public function index()
    {
		$search_string = \Input::get( 'search_string' );
		$query = Company::where( 'company_type_id', 0 )->where( 'status_id', 0 );
		if ( !empty( $search_string )) $query = $query->where( 'title', 'LIKE', '%' . $search_string . '%' );
		$data['companies'] = $query->orderBy( 'weight', 'desc' )
			->orderBy( 'title' )
			->get();
		$data['search_string'] = $search_string;
		return view( 'company.index', $data );
    }
	
    public function admin( $status_id=0 )
    {
		$data['companies'] = Company::with( 'status', 'company_type' )
			->where( 'status_id', $status_id )
			->where( 'company_type_id','!=', 2 )
			->orderBy( 'title', 'asc' )
			->get();
		$data['status'] = Status::find( $status_id )->first()->title;
		return view( 'company.admin', $data );
    }
	
	public function company()
    {
		$id = \Auth::user()->company_id;
		$data = Company::find( $id )->first();
		return view( 'company.show', $data )->withCompany( $data );
    }
	
    public function show($id) { // $id can be a int or a string (slug)
        if(!is_numeric($id)){$id = Company::where('slug', $id)->pluck('id');}
        if(!isset($id)){$id = 1;} // Just in case. 
        $data = Company::find( $id )->first();
        return view( 'company.show', $data )->withCompany( $data );
    }
    
    public function create()
    {
        return view( 'company.create' );
    }

    public function store( Request $request ) {
		$input = \Input::except( array( 'submit', '_token', '_method', 'image', 'image_delete' ));
		$data = Company::create( $input );
        $data->slug = Display::linkify($data->title);
        $dupe_id = Company::where('slug', $data->slug)->pluck('id');
        if(!empty($dupe_id)){
            $data->slug = $data->slug . '-co';
        }
		$data->save();
		$data['image'] = $this->image_upload( $request, $data->id );
		$data->save();
		return redirect()->action( 'CompanyController@show', ['id' => $data->id ] );
    }

    public function edit( $id )
    {
		$data['company'] = Company::find( $id )->first();
		return view( 'company.edit', $data )->first();
    }
	
    public function user()
    {
		$id = \Auth::user()->company_id;
		$data['company'] = Company::find( $id )->first();
		return view( 'company.edit', $data );
    }

    public function update( Request $request, $id )
    {
	    $input = \Input::except( array( 'submit', '_token', '_method', 'image', 'image_delete' ));
		$record = Company::find( $id )->first();
		foreach ( $input AS $key => $value ) $record[$key] = $value;
		$record['image'] = $this->image_upload( $request, $id, $record->image );
		$record->save();
		if($record->status_id != 0){
			\App\AgencyCompany::where('company_id', $record->id)->delete();
		}
		return redirect()->action( 'CompanyController@show', ['id' => $record->id ] );
    }
	
	protected function image_upload( Request $request, $id, $image=null ) 
	{
		$module = 'companies';
		if ( null !== $request->file( 'image' )) {
			$imageName = $module . '-' . $id . '.' . $request->file( 'image' )
                ->getClientOriginalExtension();
			$destinationPath = base_path() . '/public/data/' . $module . '/img';
			$request->file( 'image' )->move( $destinationPath, $imageName );
			$image = $imageName;
		} elseif ( isset( $request->image_delete )) {
			$image = null;
		}
		return $image;
	}
    
    // Goto: script/mass_slug_update After uncommnenting out the route in routes.php
    public function generate_all_company_slugs() {
        $records = \App\Company::all(); 
        foreach($records as $record){
            if(empty($record->slug)){
                $record->slug = Display::linkify($record->title);
                echo $record->slug . 'Saved in Slugs!<br>';
                $record->save();
            }else{
                echo $record->slug . ' already exists! Did not save...<br>';
            }
        }
    }
    
    public function generate_slug($id) {
        $company = \App\Company::find( $id )->first();
        if(empty($company->slug)){
            $company->slug = Display::linkify($company->title);
            $company->save();
        }
    }
    
    // You need to add a route for it, but this would rerun the url safe slug update. 
    public function rerun_url_slug() {
        $records = \App\Company::all(); 
        foreach($records as $record){
            if(!empty($record->slug)){
                $record->slug = Display::linkify($record->title);
                echo $record->slug . ' Re-Saved in Slugs!<br>';
                $record->save();
            }
        }
    }
}

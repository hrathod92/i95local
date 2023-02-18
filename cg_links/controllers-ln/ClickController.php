<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use \App\Click;
use \App\Company;

class ClickController extends Controller
{

	public function __construct()
	{
		$this->middleware( 'auth', [ 'except' => [ 'setFromFrontEnd' ]]);
		$this->middleware('site');
		$this->beforeFilter( 'csrf', array( 'on'=>'post' ));
		$this->click_types_that_can_be_edited = [ 'video', 'release', 'event', 'article', 'ad', 'job', 'newsletter', 'sponsored' ];
	}		

	public function index(Request $request)
	{
		
		if(!empty($request->company)){
			$company = $request->company;			
		}else{
			$company = null;
		}
		if(!empty($request->type)){
			$type = $request->type;			
		}else{
			$type = 'All';
		}
		if(\Auth::user()->role != 'admin' ) redirect( '/clicks/company' );
		$query = Click::with( 'company', 'clickable' );
		if(!empty($company)){
			$query = $query->where('company_id', $company);
		}
		if($type != 'All'){
			$query = $query->where('clickable_type', $type);
		}
		$data['clicks'] = $query->orderBy( 'click_count', 'desc' )
			->orderBy( 'clickable_type' )
			->orderBy( 'clickable_id', 'desc' )
			->get();
		$data['type'] = $type;
		$data['company_id'] = $company;
		return view( 'click.index', $data );
	}
	
	public function type( $type='all' )
	{
		$query = Click::with( 'company', 'clickable' );
		if( \Auth::user()->role != 'admin' ) $query = $query->where( 'company_id', \Auth::user()->company_id );
		if ( $type != 'all' ) $query = $query->where( 'clickable_type', $type );
		$data['clicks'] = $query->orderBy( 'clickable_id', 'desc' )->get();	
		$data['companies'] = Company::get()->toArray();
		$data['type'] = $type;
		return view( 'click.type', $data );
	}
	
	public function company( $company_id=0 )
	{
		if( \Auth::user()->role != 'admin' || $company_id == 0 ) $company_id = \Auth::user()->company_id;
		$data['clicks'] = Click::with( 'company', 'clickable' )
			->where( 'company_id', $company_id )
			->orderBy( 'clickable_id', 'desc' )
			->get();
		$data['company_title'] = Company::where( 'id', $company_id )->pluck( 'title' );
		return view( 'click.company', $data );
	}

	public function set( $type, $item_id )
	{
		Click::set( $type, $type );
		return redirect( '/clicks' );  
	}

	public function setFromFrontEnd( $type, $item_id, $action='' )
	{
		$type = filter_var ($type, FILTER_SANITIZE_STRING);
		$item_id = filter_var ( $item_id, FILTER_SANITIZE_NUMBER_INT);
		if(!empty($type) && !empty($item_id) && is_numeric($item_id)) {
			Click::set( $type, (int)$item_id );
			return 'success';
		}else {
			return 'fail';
		}
	}


}

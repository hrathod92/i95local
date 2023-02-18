<?php 

namespace App\Http\Controllers;

use App\User;
use App\Company;
use Auth;

class DashboardController extends BaseController {

	protected $layout = "templates.default";

	public function __construct() {
		$this->middleware( 'auth' );
		$this->middleware('site');
		$this->middleware( 'role:admin', [ 'only' => [ 'getAdmin' ]]);
		$this->beforeFilter( 'csrf', array('on'=>'post'));
	}
	
	public function getDashboard() {
		$dash = 'dashboard.' . Auth::user()->role;
		$data['user'] = User::find( Auth::user()->id );
		$data['company'] = Company::find( Auth::user()->company_id);

		return view( $dash, $data );
	}	

}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class HomeController extends BaseController {
	
	public function __construct() 
    {
        $this->middleware( 'site');
		}
	
	public function getIndex() {
		$data = array();
		return \View::make( 'home.home', $data );
	}

}

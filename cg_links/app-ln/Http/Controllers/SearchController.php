<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use \App\Article;

class SearchController extends Controller
{

	public function __construct()
	{
	}

	public function index()
	{
		$data['terms']  = \Input::get( 'terms' );
		return view( 'search.index', $data );
    }

}

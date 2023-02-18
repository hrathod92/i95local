<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use \App\Setting;

class SettingController extends Controller
{
		public function __construct() 
		{
				$this->middleware('site');
    }
	
    public function index()
    {
        $data['settings'] = Setting::orderBy( 'type' )->orderBy( 'title' )->get();
        return view( 'setting.index', $data );
    }

    public function create()
    {
        return view( 'setting.create' );
    }

    public function store(Request $request)
    {
        $input = \Input::all();
	    $data = Setting::create( $input );
        return view( 'setting.show', $data );
    }

    public function show($id)
    {
        $data = Setting::find( $id );
        return view( 'setting.show', $data );
    }

    public function edit($id)
    {
        $data['setting'] = Setting::find( $id );
        return view( 'setting.edit', $data );
    }

    public function update(Request $request, $id)
    {
		$input = \Input::except( array( 'submit', '_token', '_method' ));
        $record = Setting::find( $id );
		foreach ( $input AS $key => $value ) {
			$record[$key] = $value;
		}
        $record->save();
        return view( 'setting.show', $record );  
    }

    public function destroy($id)
    {
        //
    }
}

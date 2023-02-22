<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use \App\Demo;

class DemoController extends Controller
{
    public function index()
    {
        $data['demos'] = Demo::all();
        return view( 'demo.index', $data );
    }

    public function create()
    {
        return view( 'demo.create' );
    }

    public function store(Request $request)
    {
        $input = \Input::all();
	    $data = Demo::create( $input );
        return view( 'demo.show', $data );
    }

    public function show($id)
    {
        $data = Demo::find( $id )->first();
        return view( 'demo.show', $data );
    }

    public function edit($id)
    {
        $data['demo'] = Demo::find( $id )->first();
        return view( 'demo.edit', $data );
    }

    public function update(Request $request, $id)
    {
		$input = \Input::except( array( 'submit', '_token', '_method' ));
        $record = Demo::find( $id )->first();
		foreach ( $input AS $key => $value ) {
			$record[$key] = $value;
		}
        $record->save();
        return view( 'demo.show', $record );  
    }

    public function destroy($id)
    {
        //
    }
}

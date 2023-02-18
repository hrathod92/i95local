<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use \App\Sponsored;

class SponsoredController extends Controller
{
    public function index()
    {
			$data['sponsoreds'] = Sponsored::all();
			return view( 'sponsored.index', $data );
    }
	
	
    public function admin()
    {
			$data['sponsoreds'] = Sponsored::orderBy( 'title' )->get();
			return view( 'sponsored.admin', $data );
    }

    public function create()
    {
        return view( 'sponsored.create' );
    }

    public function store(Request $request)
    {
			$input = \Input::all();
			$data = Sponsored::create( $input );
			$file=$request->file('image');
			if ( isset( $file )){
				$imageName='sponsored-'. $data->id .'.'.$request->file('image')->getClientOriginalExtension();
				$destinationPath = base_path() . '/public/data/sponsoreds/img';
				$request->file('image')->move($destinationPath, $imageName);
				$data->image=$imageName;
			}
			$data->save();
			return view( 'sponsored.show', $data );
    }

    public function show($id)
    {
        $data = Sponsored::find( $id );
        return view( 'sponsored.show', $data );
    }

    public function edit($id)
    {
        $data['sponsored'] = Sponsored::find( $id );
        return view( 'sponsored.edit', $data );
    }

    public function update(Request $request, $id)
    {
		$input = \Input::except( array( 'submit', '_token', '_method' ));
		$record = Sponsored::find( $id );
		foreach ( $input AS $key => $value ) {
			$record[$key] = $value;
		}
		$file=$request->file('image');
		if ( isset( $file )) {
			$imageName='sponsored-'.$id.'.'.$request->file('image')->getClientOriginalExtension();
			$destinationPath = base_path() . '/public/data/sponsoreds/img';
			$request->file('image')->move($destinationPath, $imageName);
			$record['image']=$imageName;
		} elseif ( isset( $request->image_delete )) {
			$record['image'] = null;
		}
		$record->save();
		return view( 'sponsored.show', $record );  
    }
	
    public function destroy($id)
    {
        //
    }

}

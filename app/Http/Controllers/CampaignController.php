<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use \App\Campaign;

class CampaignController extends Controller
{
    public function index()
    {
			$data['campaigns'] = Campaign::all();
			return view( 'campaign.index', $data );
    }
	
	
    public function admin()
    {
			$data['campaigns'] = Campaign::orderBy( 'id', 'desc' )->get();
			return view( 'campaign.admin', $data );
    }

    public function create()
    {
        return view( 'campaign.create' );
    }

    public function store(Request $request)
    {
        $input = \Input::all();
	    $data = Campaign::create( $input );
        return view( 'campaign.show', $data );
    }

    public function show($id)
    {
        $data = Campaign::find( $id );
        return view( 'campaign.show', $data );
    }

    public function edit($id)
    {
        $data['campaign'] = Campaign::find( $id );
        return view( 'campaign.edit', $data );
    }

    public function update(Request $request, $id)
    {
		$input = \Input::except( array( 'submit', '_token', '_method' ));
        $record = Campaign::find( $id );
		foreach ( $input AS $key => $value ) {
			$record[$key] = $value;
		}
        $record->save();
        return view( 'campaign.show', $record );  
    }

    public function destroy($id)
    {
        //
    }
}

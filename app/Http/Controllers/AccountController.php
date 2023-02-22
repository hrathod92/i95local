<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use \App\Account;

class AccountController extends Controller
{
    public function index()
    {
        $data['accounts'] = Account::all();
        return view( 'account.index', $data );
    }

    public function create()
    {
        return view( 'account.create' );
    }

    public function store(Request $request)
    {
        $input = \Input::all();
	    $data = Account::create( $input );
        return view( 'account.show', $data );
    }

    public function show($id)
    {
        $data = Account::find( $id )->first();
        return view( 'account.show', $data );
    }

    public function edit($id)
    {
        $data['account'] = Account::find( $id )->first();
        return view( 'account.edit', $data );
    }

    public function update(Request $request, $id)
    {
		$input = \Input::except( array( 'submit', '_token', '_method' ));
        $record = Account::find( $id )->first();
		foreach ( $input AS $key => $value ) {
			$record[$key] = $value;
		}
        $record->save();
        return view( 'account.show', $record );  
    }

    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use \App\Message;

class MessageController extends Controller
{
    public function index()
    {
			$data['messages'] = Message::where('company_id', \Auth::user()->company_id)->orderBy( 'id', 'desc' )->get();
			return view( 'message.index', $data );
    }

    public function user( $id=0 )
    {
			if ( $id == 0 || \Auth::user()->role != 'admin' ) $id = \Auth::user()->id;
			    $data['messages'] = Message::where('user_id', $id)->orderBy( 'id', 'desc' )->get();
			return view( 'message.user', $data );
    }
	
    public function admin()
    {
			$data['messages'] = Message::orderBy( 'id', 'desc' )->get();
			return view( 'message.admin', $data );
    }

    public function create()
    {
        return view( 'message.create' );
    }

    public function store(Request $request)
    {
			$input = \Input::except( array( 'submit', '_token', '_method' ));
			$data = Message::create( $input );
			$data->save();
			return view( 'message.show', $data );
    }

    public function show($id)
    {
        $data = Message::find( $id );
        return view( 'message.show', $data );
    }

    public function edit($id)
    {
        $data['message'] = Message::find( $id );
        return view( 'message.edit', $data );
    }

    public function update(Request $request, $id)
    {
			$input = \Input::except( array( 'submit', '_token', '_method' ));
			$record = Message::find( $id );
			foreach ( $input AS $key => $value ) {
				$record[$key] = $value;
			}
			$record->save();
			return view( 'message.show', $record );  
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use \App\Feed;

class FeedController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
      $query = Feed::orderBy( 'title' );     
      if ( $search_string = \Input::get( 'search_string' )) {
        $query = $query->where( 'title', 'LIKE', '%' . $search_string . '%' );
      }
      $data['items'] = $query->get();
      $data[ 'search_string' ] = $search_string;
      return view( 'feed.index', $data );
    }

    public function admin()
    {
      $data['feeds'] = Feed::all();
      return view( 'feed.admin', $data );
    }
  
    public function show($id)
    {
      $data = Feed::find( $id )->first();
      return view( 'feed.show', $data );
    }


    public function create()
    {
        return view( 'feed.create' );
    }

    public function store(Request $request)
    {
      $input = \Input::except([ 'uploadfile' ]);
      $item = Feed::create( $input );
      return redirect( '/feeds/' . $item->id );
    }

    public function edit($id)
    {
      $data['item'] = Feed::find( $id )->first();
      return view( 'feed.edit', $data );
    }

    public function update(Request $request, $id)
    {
        $input = \Input::except( array( 'submit', '_token', '_method', 'uploadfile' ));
        $record = Feed::find( $id )->first();
        foreach ( $input AS $key => $value )
        {
            $record[$key] = $value;
        }
        $record->save();
        return redirect( '/feeds/' . $id );
    }

    public function destroy($id)
    {
        $data= Feed::find($id)->first();
        $data->delete();
        return redirect( '/feeds' );
    }

    public function remove(Request $request)
    {
        $feed = Feed::find($request->input('feed_id'))->first();
        $feed->delete();
        return redirect( '/feeds/admin' );
    }
}

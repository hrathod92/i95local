<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\VideoType;

class VideoTypeController extends Controller
{

  public function __construct()
  {
    $publicMethods = [ 'show' ];
    $this->middleware('auth', ['except' => $publicMethods]);
  }

  public function admin()
  {
    $data = [ 'items' => VideoType::all() ];
    return view( 'video-type.admin', $data );
  }
  
  public function show( $id )
  {
    $data = VideoType::find( $id )->first();
    return view( 'video-type.show', $data );
  }

  public function create()
  {
    return view( 'video-type.create' );
  }

  public function store( Request $request )
  {
    $item = VideoType::create($request->all());
    return redirect()->route( 'video-type.admin', $item );
  }

  public function edit( $id )
  {
    $data['item'] = VideoType::find( $id );
    return view( 'video-type.edit', $data );
  }

  public function update( Request $request, $id )
  {
    $item = VideoType::find( $id );
    $item->fill( $request->all() );
    $item->save();
    $data['item'] = $item;
    return redirect()->route( 'video-types.admin', $data );
  }

  public function destroy( VideoType $item )
  {
  }

}

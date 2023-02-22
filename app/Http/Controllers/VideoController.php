<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\VideoType;
use \App\Video;
use \App\Company;
use \App\Click;

class VideoController extends Controller
{
     public function __construct()
    {
        $publicMethods = [
            'index',
            'show',
        ];

        $this->middleware('auth', ['except' => $publicMethods]);
    }

		public function index( $video_type_id=0 ){
		$query = Video::with( 'video_type', 'status' );
		if ( $video_type_id != 0 ){
			$query = $query->where( 'video_type_id', $video_type_id );
      		$type = \App\VideoType::find($video_type_id)->first();
			$data['type']= $type->title;
		}
		if ( $search_string = \Input::get( 'search_string' )) {
        	$query = $query->where( function($query) use ( $search_string )
				{
					$query->where( 'title', 'LIKE', '%' . $search_string . '%' )
					->orWhere( 'keywords', 'LIKE', '%' . $search_string . '%' );
				});
      }
      $data['items'] = $query
				->where( 'status_id', 0 )
				->orderBy( 'title' )
				->get();
      $data[ 'video_type_id' ] = $video_type_id;
      $data[ 'search_string' ] = $search_string;
      return view( 'video.index', $data );
    }
	
    public function admin()
    {
			$data['videos'] = Video::with( 'video_type', 'status', 'favorite', 'company' )
				->orderBy( 'status_id' )
				->orderBy( 'title' )
				->get();
			return view( 'video.admin', $data );
    }
	
    public function company( $id=0 )
    {
			if ( $id == 0 || \Auth::user()->role != 'admin' ) $id = \Auth::user()->company_id;
			$data['items'] = Video::with( 'video_type', 'status', 'favorite', 'company' )
				->where( 'company_id', $id )
				->orderBy( 'title' )
				->get();
			$data['company'] = Company::find( $id )->first();
			return view( 'video.company', $data );
    }

    public function create()
    {
       return view( 'video.create' );
    }

    public function store(Request $request)
    {
      $validator = \Validator::make( $request->all(), Video::$rules );
			if ($validator->passes()) {
				$input = \Input::all();
		    $data = Video::create( $input );
    	  return view( 'video.show', $data );
			} else {
					return redirect( 'videos/create' )
					->with( 'message', 'The following errors occurred' )
					->withErrors( $validator )
					->withInput();
			}  			
    }

    public function show($id)
    {
			Click::set( 'video', $id );
      $data = Video::find( $id )->first();
      return view( 'video.show', $data );
    }

    public function edit( $id )
    {
      $data['video'] = Video::find( $id )->first();
      return view( 'video.edit', $data );
    }

    public function update(Request $request, $id)
    {		
		$input = \Input::except( array( 'submit', '_token', '_method' ));
    $record = Video::find( $id )->first();
		foreach ( $input AS $key => $value ) {
			$record[$key] = $value;
		}
		$record->save();
		$record->preview = true;
		return view( 'video.show', $record );  
    }
}

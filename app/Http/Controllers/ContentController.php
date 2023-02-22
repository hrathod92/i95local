<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use \App\Content;

class ContentController extends Controller
{
    public function __construct()
		{
				$this->middleware('site');
        // $this->beforeFilter( 'csrf', array('on'=>'post'));
    }

    public function content( Request $request, $slug )
    {
			$data = Content::where( 'slug', '=', $slug )->first();

			if ( !empty( $data ))
			{
				return view( 'content.view', $data );
			}
			else
			{
				$data['title'] = $request->fullUrl();
				return view( 'content.coming-soon', $data );
			}
    }

    public function index()
    {
        $data['contents'] = Content::orderBy( 'Title' )->get();
        return view( 'content.index', $data );
    }
	
		public function contact()
    {
        return view( 'content.contact' );
    }

    public function create()
    {
        return view( 'content.create' );
    }

    public function store( Request $request )
    {
			$validator = \Validator::make( $request->all(), Content::$rules );
			if ($validator->passes()) {
				$input = \Input::except(['image']);
				$data = Content::create( $input );
				$data->save();
				$file = $request->file('image');
				if ( isset($file )) {
					$imageName='contents-'. $data->id .'.'.$request->file('image')->getClientOriginalExtension();
					$destinationPath = base_path() . '/public/data/contents/img';
					$request->file('image')->move($destinationPath, $imageName);
					$data->image=$imageName;
				}
				$data->save();
				return view( 'content.show', $data );
			} else {
				return redirect( 'contents/create' )
					->with( 'message', 'The following errors occurred' )
					->withErrors( $validator )
					->withInput();
			}
    }

    public function show($id)
    {
        $data = Content::find( $id )->first();
        return view( 'content.show', $data );
    }

    public function edit($id)
    {
        $data['content'] = Content::find( $id )->first();
        return view( 'content.edit', $data );
    }

    public function update(Request $request, $id)
    {
		$input = \Input::except( array( 'submit', '_token', '_method', 'image', 'image_delete' ));
    $record = Content::find( $id )->first();
		foreach ( $input AS $key => $value ) {
			$record[$key] = $value;
		}

		$file = $request->file( 'image' );
		if ( isset( $file )) {
			$imageName = 'contents-'.$id.'.'.$request->file('image')->getClientOriginalExtension();
			$destinationPath = base_path() . '/public/data/contents/img';
			$request->file('image')->move($destinationPath, $imageName);
			$record['image'] = $imageName;
		} elseif ( isset( $request->image_delete )) {
			$record['image'] = null;
		}

		$record->save();
		$record->preview = true;
		return view( 'content.show', $record );
    }

    public function destroy($id)
    {
        $data= Content::find($id)->first();
        $data->delete();
        $this->index();
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use \App\Author;

class AuthorController extends Controller
{
    public function index()
    {
			$data['authors'] = Author::all();
			return view( 'author.index', $data );
    }
	
    public function company( $id=0 )
    {
			if ( $id == 0 || \Auth::user()->role != 'admin' ) $id = \Auth::user()->company_id;
			$data['authors'] = Author::with( 'status', 'company' )
				->where( 'company_id', $id )
				->orderBy( 'title' )
				->get();
			return view( 'author.company', $data );
    }
	
    public function show($id)
    {
        $data = Author::find( $id );
        return view( 'author.show', $data );
    }

    public function admin()
    {
			$data['authors'] = Author::orderBy( 'title' )->get();
			return view( 'author.admin', $data );
    }

    public function create()
    {
        return view( 'author.create' );
    }

    public function store(Request $request)
    {
			$input = \Input::except( array( 'submit', '_token', '_method', 'image' ));
			$data = \App\Author::create( $input );
			$file=$request->file('image');
			if (isset($file)){
				$imageName='authors-'. $data->id .'.'.$request->file('image')->getClientOriginalExtension();
				$destinationPath = base_path() . '/public/data/authors/img';
				$request->file('image')->move($destinationPath, $imageName);
				$data->image=$imageName;
			}
			$data->save();
			return view( 'author.show', $data );
    }

    public function edit($id)
    {
        $data['author'] = Author::find( $id );
        return view( 'author.edit', $data );
    }

    public function update(Request $request, $id)
    {
			$input = \Input::except( array( 'submit', '_token', '_method', 'image', 'image_delete', 'company' ));
			$record = Author::find( $id );
			foreach ( $input AS $key => $value ) {
				$record[$key] = $value;
			}
			$file=$request->file('image');
			if ( isset( $file )) {
				$imageName='authors-'.$id.'.'.$request->file('image')->getClientOriginalExtension();
				$destinationPath = base_path() . '/public/data/authors/img';
				$request->file('image')->move($destinationPath, $imageName);
				$record['image']=$imageName;
			} elseif ( isset( $request->image_delete )) {
				$record['image'] = null;
			}
			$record->save();
			$record->preview = true;
			if(\Auth::user()->role == 'agency'){
				return redirect('/dashboard');
			}else{
				return view( 'author.show', $record );  
			}
			
    }

		public function apiGetCompanyAuthors( $company_id ) {
			$authors = Author::where( 'company_id', $company_id )->orderBy( 'title' )->get();
			$authorsStr = '<option value=0>None</option>';
			foreach ( $authors AS $author ) $authorsStr .= '<option value=' . $author->id . '>' . $author->title . '</option>';
			return response()->json( array( 'success' => true, 'html' => $authorsStr ));
		}
}

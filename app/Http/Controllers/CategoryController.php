<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use \App\Category;
use \App\CategoryTreeItem;

class CategoryController extends Controller
{
	public function __construct() 
	{
		$this->middleware( 'auth', [ 'except' => [ 'index', 'show' ]]);
		//$this->middleware( 'role:admin', [ 'except' => [ 'index', 'show' ]]);
		//// $this->beforeFilter( 'csrf', array( 'on'=>'post' ));
		$this->middleware('site');
	}

	public function index()
	{
		$data['items'] = Category::with( 'category_level' )
			->select( 'categories.*' )
			->join( 'categories AS parents', 'categories.parent_id', '=', 'parents.id' )
			->where( 'categories.slug', '!=', 'none' )
			->where( 'categories.status_id', 0 )
			->orderBy( 'parents.title' )
			->orderBy( 'categories.level' )
			->orderBy( 'categories.title' )
			->get();
		return view( 'category.index', $data );
	}

	public function show($id)
	{
		$data['item'] = Category::with( 'parent' )->find( $id )->first();
		return view( 'category.show', $data );
	}

	public function create()
	{            
		$data['item'] = new Category();
		return view( 'category.create', $data);
	}

	public function store(Request $request)
	{
		$input = \Input::except( ['image'] );
		$category = Category::create( $input );
		$category->save();
		return redirect( '/categories' );
	}

	public function edit($id)
	{
		$data['item'] = Category::find( $id )->first();
		return view( 'category.edit', $data );
	}

	public function update(Request $request, $id)
	{
		$input = \Input::except( array( 'submit', '_token', '_method' ));
		$record = Category::find( $id )->first();
		foreach ( $input AS $key => $value ) $record[$key] = $value;
		$record->save();
		return redirect( '/categories' );
	}

	public function destroy($id)
	{
		$data = Category::find($id)->first();
		$data->delete();
		if($data->parent_id != 0) return redirect('/categories/'.$data->parent_id.'/edit');
		return redirect('/categories');
	}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use \App\Menu;

class MenuController extends Controller
{
		public function __construct() 
		{
				$this->middleware('site');
        //$this->middleware( 'role:admin', [ 'except' => [ 'content' ]]);
        //$this->beforeFilter( 'csrf', array('on'=>'post'));
    }
	
    public function index()
    {
        $data['menus'] = Menu::orderBy( 'title' )->get();
        return view( 'menu.index', $data );
    }

    public function create()
    {
        return view( 'menu.create' );
    }

    public function store(Request $request)
    {
			$input = \Input::all();
			$data = Menu::create( $input );
			return redirect()->action( 'MenuController@index' );
    }

    public function show($id)
    {
        $data = Menu::find( $id );
        return view( 'menu.show', $data );
    }

    public function edit($id)
    {
        $data['menu'] = Menu::find( $id );
        return view( 'menu.edit', $data );
    }

    public function update(Request $request, $id)
    {
			$input = \Input::except( array( 'submit', '_token', '_method' ));
					$record = Menu::find( $id );
			foreach ( $input AS $key => $value ) {
				$record[$key] = $value;
			}
			$record->save();
			return redirect()->action( 'MenuController@index' );
    }
	
		public function addSite(Request $request)
		{
				$menu = Menu::find($request->menu_id);
				$addSite = true;
				if($menu->sites->count() > 0)
				{
						foreach($menu->sites as $site)
						{
								if($request->site_id == $site->id)
								{
										$addSite = false;
								}
						}
				}
				if($addSite)
				{
						$menu->sites()->attach($request->site_id);
				}
				return redirect('/menus/'.$menu->id.'/edit');
		}
	
		public function removeSite(Request $request)
		{
				$menu = Menu::find($request->menu_id);
				$menu->sites()->detach($request->site_id);
				return redirect('/menus/'.$menu->id.'/edit');
		}
}

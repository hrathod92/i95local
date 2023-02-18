<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use \App\Block;

class BlockController extends Controller
{
		public function __construct() 
		{
				$this->middleware('site');
    }
	
    public function index()
    {
			$data['blocks'] = Block::all();
			return view( 'block.index', $data );
    }

    public function create()
    {
       return view( 'block.create' );
    }

    public function store(Request $request)
    {
      $input = \Input::except([ 'image' ]);
      $data = Block::create( $input );
			
      $data->save();
			return view( 'block.show', $data );
    }

    public function show($id)
    {
			$data = Block::find( $id );
			return view( 'block.show', $data );
    }

    public function edit($id)
    {
			$data['block'] = Block::find( $id );
			return view( 'block.edit', $data );
    }

    public function update(Request $request, $id)
    {
			$input = \Input::except( array( 'submit', '_token', '_method', 'image' ));
			$record = Block::find( $id );
			foreach ( $input AS $key => $value ) {
				$record[$key] = $value;
			}
			
			$record->save();
			return view( 'block.show', $record );  
    }
	
		protected function save_image( $file, $module, $id ) {
			$imageName= $module . '-'. $id . '.' . $file->getClientOriginalExtension();
			$destinationPath = base_path() . '/public/data/' . $module . '/img';
			$file->move( $destinationPath, $imageName );
			return $imageName;			
		}

    public function destroy($id)
    {
        //
    }
	
		public function addSite(Request $request)
		{
				$block = Block::find($request->block_id);
				
				$addSite = true;
			
				if($block->sites->count() > 0)
				{
						foreach($block->sites as $site)
						{
								if($request->site_id == $site->id)
								{
										$addSite = false;
								}
						}
				}
			
				if($addSite)
				{
						$block->sites()->attach($request->site_id);
				}
			
				return redirect('/blocks/'.$block->id.'/edit');
		}
	
		public function removeSite(Request $request)
		{
				$block = Block::find($request->block_id);
				$block->sites()->detach($request->site_id);
			
				return redirect('/blocks/'.$block->id.'/edit');
		}
}

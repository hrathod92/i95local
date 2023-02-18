<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use \App\HeroSlider;

class HeroSliderController extends Controller
{
		public function __construct() 
		{
				$this->middleware('site');
    }
	
    public function index()
    {
		$data['sliders'] = HeroSlider::all();
		
		return view( 'hero_slider.index', $data );
    }

    public function create()
    {
        return view( 'hero_slider.create' );
    }

    public function store(Request $request)
    {
        $input = \Input::except([ 'uploadfile' ]);
        
        $data = HeroSlider::create( $input );
        
        $uploadfile = $request->file('uploadfile');

        if (isset($uploadfile))
        {
            $rand_string = $this->generateRandomString();

            $fileName = $data->id . '_' . $rand_string . '.' . $uploadfile->getClientOriginalExtension();

            $destinationPath = base_path() . '/public/data/hero_sliders';

            $request->file('uploadfile')->move($destinationPath, $fileName);

            $data->image = $fileName;
        }
			
        $data->save();
	    
	    return view( 'hero_slider.show', $data );
    }

    public function show($id)
    {
		$data = HeroSlider::find( $id );
		
		return view( 'hero_slider.show', $data );
    }

    public function edit($id)
    {
		$data['slider'] = HeroSlider::find( $id );
			
		return view( 'hero_slider.edit', $data );
    }

    public function update(Request $request, $id)
    {
		$input = \Input::except( array( 'submit', '_token', '_method', 'uploadfile' ));
		
		$record = HeroSlider::find( $id );
		
		foreach ( $input AS $key => $value ) 
		{
			$record[$key] = $value;
		}
		
		$uploadfile = $request->file('uploadfile');

        if (isset($uploadfile))
        {
            $rand_string = $this->generateRandomString();
            $fileName = $record->id . '_' . $rand_string . '.' . $uploadfile->getClientOriginalExtension();
            $destinationPath = base_path() . '/public/data/hero_sliders';
            $request->file('uploadfile')->move($destinationPath, $fileName);
            $record->image = $fileName;
        }
			
		$record->save();
		return view( 'hero_slider.show', $record );  
    }

    public function destroy($id)
    {
        $data= HeroSlider::find($id);
        $data->delete();
        return redirect('/sliders');
    }
    
    private function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++)
        {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }
	
}

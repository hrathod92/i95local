<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use \App\Faq;

class FaqController extends Controller
{
    public function index()
    {
        $data['faqs'] = Faq::orderBy( 'refno' )->get();
        return view( 'faq.index', $data );
    }

    public function create()
    {
        return view( 'faq.create' );
    }

    public function store(Request $request)
    {
			$input = \Input::all();
			$data = Faq::create( $input );
			return view( 'faq.show', $data );
    }

    public function show($id)
    {
			$data = Faq::find( $id )->first();
			return view( 'faq.show', $data );
    }

    public function edit($id)
    {
			$data['faq'] = Faq::find( $id )->first();
			return view( 'faq.edit', $data );
    }

    public function update(Request $request, $id)
    {
			$input = \Input::except( array( 'submit', '_token', '_method' ));
			$record = Faq::find( $id )->first();
			foreach ( $input AS $key => $value ) {
				$record[$key] = $value;
			}
			$record->save();
			return view( 'faq.show', $record );  
    }
	
		public function getSitemap() {
			 //$pages = Page::all();
        return response()->view('sitemap')->header('Content-Type', 'text/xml');
		}	

}

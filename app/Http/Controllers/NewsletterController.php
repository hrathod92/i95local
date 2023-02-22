<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use \App\Newsletter;

class NewsletterController extends Controller
{
    public function index( $title=0 )
    {
			$query = Newsletter::with( 'newsletter_year', 'status' )->where( 'status_id', 0 );
		  if ( $title != 0) {
				$query = $query->where( 'newsletter_year', $title );
      } elseif ( \Input::get( 'newsletter_year' )) {
        $title = \Input::get( 'newsletter_year' );
        $query= $query->where( 'title', $title );
      }
      $data['items'] = $query->orderBy( 'title', 'DESC' )->get();
      $data[ 'newsletter_year' ] = $title;
			return view( 'newsletter.index', $data );
    }
	
    public function admin()
    {
			$data['newsletters'] = Newsletter::with( 'status' )->orderBy( 'title', 'DESC' )->get();
			return view( 'newsletter.admin', $data );
    }
	
    public function show( $id=0 )
    {
			if ( $id == 0 ) $id = Newsletter::where( 'status_id', 0 )
				->orderBy( 'title', 'DESC' )
				->pluck( 'id' );
			$data = Newsletter::find( $id )->first();
			return view( 'newsletter.show', $data );
    }
	
    public function create()
    {
        return view( 'newsletter.create' );
    }
	
    public function store(Request $request)
    {
			$input = \Input::except( ['image', 'document', 'image_delete', 'document_delete'] );
			$data = Newsletter::create( $input );
			$data->save();
			$file = $request->file( 'image' );

			if (isset( $file )){
				$imageName= 'newsletter-image-'. $data->id . '.' . $request->file('image')->getClientOriginalExtension();
				$destinationPath = base_path() . '/public/data/newsletters/img';
				$request->file( 'image' )->move( $destinationPath, $imageName );
				$data->image=$imageName;
			}
			$file2 = $request->file('document');
			if ( isset( $file2 )) {
				$docName= 'newsletter-document-'. $data->id . '.' . $request->file('document')->getClientOriginalExtension();
				$destinationPath = base_path() . '/public/data/newsletters/document';
				$request->file( 'document' )->move( $destinationPath, $docName );
				$data->document = $docName;
			}
			$data->save();
			return redirect( '/newsletters/'.$data->id );
    }

    public function edit($id)
    {
        $data['newsletter'] = Newsletter::find( $id )->first();
        return view( 'newsletter.edit', $data );
    }
	
	  public function update(Request $request, $id)
    {
			$input = \Input::except( array( 'submit', '_token', '_method', 'image', 'image_delete', 'document', 'document_delete' ));
			$record = Newsletter::find( $id )->first();
			foreach ( $input AS $key => $value ) {
				$record[$key] = $value;
			}
			$file = $request->file( 'image' );
			if ( isset( $file )) {
				$imageName = 'newsletter-image-' . $id . '.' . $request->file( 'image' )->getClientOriginalExtension();
				$destinationPath = base_path() . '/public/data/newsletters/img';
				$request->file( 'image' )->move( $destinationPath, $imageName );
				$record['image']=$imageName;
			} elseif ( isset( $request->image_delete )) {
				$record['image'] = null;
			}
			$file2 = $request->file( 'document' );
			if ( isset( $file2 )) {
				$docName = 'newsletter-document-' . $id . '.' . $request->file( 'document' )->getClientOriginalExtension();
				$destinationPath = base_path() . '/public/data/newsletters/document';
				$request->file( 'document' )->move( $destinationPath, $docName );
				$record['document']=$docName;
			} elseif ( isset( $request->document_delete )) {
				$record['document'] = null;
			}
			$record->save();
			$record->preview = true;
			return redirect( '/newsletters/'.$id );
    }

}

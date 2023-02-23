<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use \App\Release;
use \App\Company;
use \App\Click;

class ReleaseController extends Controller
{
    public function index( $release_type_id=0 )
    {
      if ( $release_type_id == 0 && \Input::get( 'release_type_id' )) $release_type_id = \Input::get( 'release_type_id' );
      $query = Release::with( 'release_type' );
			if ( $release_type_id != 0 ) $query = $query->where( 'release_type_id', $release_type_id );
      if ( $search_string = \Input::get( 'search_string' )) {
        $query = $query->where( function( $q ) use ( $search_string ) {
          $q->where( 'title', 'LIKE', '%' . $search_string . '%' )
            ->orWhere( 'keywords', 'LIKE', '%' . $search_string . '%' );
        });
      }
      $data['items'] = $query->where( 'status_id', 0 )
				->orderBy( 'id', 'desc' )
				->take( 100 )
				->get();
		
      $data[ 'release_type_id' ] = $release_type_id;
	  if($release_type_id != 0){
		$type = \App\ReleaseType::find($release_type_id)->first();
	  	$data['type'] = $type->title;
	  }
      $data[ 'search_string' ] = $search_string;
      return view( 'release.index', $data );
    }
	
    public function company( $id=0 )
    { 
			if ( $id == 0 || \Auth::user()->role != 'admin' ) $id = \Auth::user()->company_id;
			$data['items'] = Release::with( 'release_type', 'company' )
				->where( 'company_id', $id )
				->orderBy( 'id', 'desc' )
				->take( 100 )
				->get();
			$data['company'] = Company::find( $id )->first();
			return view( 'release.company', $data );
    }
	
    public function admin()
    {
			$data['releases'] = Release::with( 'release_type' )
				->orderBy( 'id', 'desc' )
				->get();
			// $exports = Release::select('title','first_name','last_name','contact_title','phone','email','release_type_id','company_name_sub')
			// 	->orderBy( 'id', 'desc' )
			// 	->get();
			// foreach($exports as $export){
			// 	$releaseType = \App\ReleaseType::find($export->release_type_id)->first();
			// 	$export->release_type_id = $releaseType->title;
			// }
			// $data['export'] = $exports;
			$data['export']['reportName'] = "Inbox_Information";
			return view( 'release.admin', $data );
    }
	
    public function show($id)
    {
			Click::set( 'release', $id );
			$data = Release::find( $id )->first();
			return view( 'release.show', $data );
    }

    public function create()
    {
        return view( 'release.create' );
    }

    public function store(Request $request)
    {	
			$validator = Validator::make($request->all(), [
					'image' => 'image',
			]);
			if ($validator->fails()) {
					return back()->withErrors($validator)->withInput();
			}
			$input = \Input::except( array( 'submit', '_token', '_method', 'image', 'image_delete' ));
			$data = Release::create( $input );
			$file=$request->file('image');
			if (isset($file)){
				$imageName='releases-'. $data->id .'.'.$request->file('image')->getClientOriginalExtension();
				$destinationPath = base_path() . '/public/data/releases/img';
				$request->file('image')->move($destinationPath, $imageName);
				$data->image=$imageName;
			}
			$data->save();
			return view( 'release.show', $data );
    }


    public function edit($id)
    {
			$data['release'] = Release::find( $id )->first();
			return view( 'release.edit', $data );
    }

    public function update( Request $request, $id )
    {
			$validator = Validator::make($request->all(), [
					'image' => 'image',
			]);
			if ($validator->fails()) {
					return back()->withErrors($validator)->withInput();
			}
			$input = \Input::except( array( 'submit', '_token', '_method', 'image', 'image_delete' ));
			$record = Release::find( $id )->first();
			foreach ( $input AS $key => $value ) {
				$record[$key] = $value;
			}
			$file=$request->file('image');
			if ( isset( $file )) {
				$imageName='releases-'.$id.'.'.$request->file('image')->getClientOriginalExtension();
				$destinationPath = base_path() . '/public/data/releases/img';
				$request->file('image')->move($destinationPath, $imageName);
				$record['image']=$imageName;
			} elseif ( isset( $request->image_delete )) {
				$record['image'] = null;
			}
			$record->save();
			$record->preview = true;
			return view( 'release.show', $record );  
    }

		public function uploadImage(Request $request) 
		{
			$CKEditor = $request->input('CKEditor');
			$funcNum  = $request->input('CKEditorFuncNum');
			
			// Image uploads path relative to your Website root
			$upload_dir = '/uploads/';

			// If 1 and filename exists, RENAME file, adding "_NR" to the end of filename (name_1.ext, name_2.ext, ..)
			// If 0, will OVERWRITE the existing file
			define('RENAME_F', 1);

			// Image size settings
			$imgsets = array(
			 'maxsize' => 2000,    // maximum file size, in KiloBytes (2 MB)
			 'maxwidth' => 1600,   // maximum allowed width, in pixels
			 'maxheight' => 1200,  // maximum allowed height, in pixels
			 'minwidth' => 10,     // minimum allowed width, in pixels
			 'minheight' => 10,    // minimum allowed height, in pixels
			 'type' => array('bmp', 'gif', 'jpeg', 'jpg', 'png'),  // allowed extensions
			);

			$re = '';

			if(isset($_FILES['upload']) && strlen($_FILES['upload']['name']) > 1) {
				$upload_dir = trim($upload_dir, '/') .'/';
				define('IMG_NAME', preg_replace('/\.(.+?)$/i', '', basename($_FILES['upload']['name'])));  //get filename without extension

				// get protocol and host name to send the absolute image path to CKEditor
				$protocol = !empty($_SERVER['HTTPS']) ? 'https://' : 'http://';
				$site = $protocol. $_SERVER['SERVER_NAME'] .'/';
				$sepext = explode('.', strtolower($_FILES['upload']['name']));
				$type = end($sepext);    // gets extension
				list($width, $height) = getimagesize($_FILES['upload']['tmp_name']);  // gets image width and height
				$err = '';         // to store the errors

				//set filename; if file exists, and RENAME_F is 1, set "img_name_I"
				// $p = dir-path, $fn=filename to check, $ex=extension $i=index to rename
				function setFName($p, $fn, $ex, $i){
					if(RENAME_F ==1 && file_exists($p .$fn .$ex)) return setFName($p, IMG_NAME .'_'. ($i +1), $ex, ($i +1));
					else return $fn .$ex;
				}

				$img_name = setFName($_SERVER['DOCUMENT_ROOT'] .'/'. $upload_dir, IMG_NAME, ".$type", 0);
				$uploadpath = $_SERVER['DOCUMENT_ROOT'] .'/'. $upload_dir . $img_name;  // full file path

				// Checks if the file has allowed type, size, width and height (for images)
				if(!in_array($type, $imgsets['type'])) $err .= 'The file: '. $_FILES['upload']['name']. ' has not the allowed extension type.';
				if($_FILES['upload']['size'] > $imgsets['maxsize']*1000) $err .= '\\n Maximum file size must be: '. $imgsets['maxsize']. ' KB.';
				if(isset($width) && isset($height)) {
					if($width > $imgsets['maxwidth'] || $height > $imgsets['maxheight']) $err .= '\\n Width x Height = '. $width .' x '. $height .' \\n The maximum Width x Height must be: '. $imgsets['maxwidth']. ' x '. $imgsets['maxheight'];
					if($width < $imgsets['minwidth'] || $height < $imgsets['minheight']) $err .= '\\n Width x Height = '. $width .' x '. $height .'\\n The minimum Width x Height must be: '. $imgsets['minwidth']. ' x '. $imgsets['minheight'];
				}

				// If no errors, upload the image, else, output the errors
				if($err == '') {
					if(move_uploaded_file($_FILES['upload']['tmp_name'], $uploadpath)) {
						$url = $site. $upload_dir . $img_name;
						$msg = IMG_NAME .'.'. $type .' successfully uploaded: \\n- Size: '. number_format($_FILES['upload']['size']/1024, 3, '.', '') .' KB \\n- Image Width x Height: '. $width. ' x '. $height;
						$re = "window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$msg')";
					}
					else $re = 'alert("Unable to upload the file")';
				}
				else $re = 'alert("'. $err .'")';
			}
			return '<script>window.parent.CKEDITOR.tools.callFunction('.$re.')</script>';
		}
 
}

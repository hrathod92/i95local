<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use \App\Company;
use \App\Video;
use \App\Status;
use \App\Helpers\Display;
use \App\AgencyCompany;

class AgencyController extends Controller
{
    public function admin( $status_id=0 )
    {
		$data['companies'] = Company::with( 'status', 'company_type' )
			->where( 'status_id', $status_id )
			->where( 'company_type_id', 2 )
			->orderBy( 'title', 'asc' )
			->get();
		$data['status'] = Status::find( $status_id )->title;
		return view( 'agency.admin', $data );
    }
	
    public function create()
    {
        return view( 'agency.create' );
    }

    public function store( Request $request )
    {
		$input = \Input::except( array( 'submit', '_token', '_method', 'image', 'image_delete' ));
		$data = Company::create( $input );
	    $data->company_type_id = 2;
		$data->save();
        $data->slug = '';
        $data['image'] = $this->image_upload( $request, $data->id );
        $data->save();

        return redirect('/agency/admin');
    }

    public function edit( $id )
    {
		$data['company'] = Company::find( $id );
		$data['clients'] = AgencyCompany::where('agency_id', $data['company']['id'])->get();
		return view( 'agency.edit', $data );
    }
	
    public function user()
    {
		$id = \Auth::user()->company_id;
		$data['company'] = Company::find( $id );
		return view( 'agency.edit', $data );
    }
	
	 public function show($id)
    {
        if(!is_numeric($id)){
            $data = Company::where('slug', $id)->get();
        }else{
            $data = Company::find( $id );
        }
		return view( 'agency.show', $data )->withCompany( $data );
    }
	
    public function update( Request $request, $id )
    {
		$input = \Input::except( array( 'submit', '_token', '_method', 'image', 'image_delete' ));
		$record = Company::find( $id );
		foreach ( $input AS $key => $value ) $record[$key] = $value;
		$record['image'] = $this->image_upload( $request, $id, $record->image );
		$record->save();
		if($record->status_id != 0){
			\App\AgencyCompany::where('agency_id', $record->id)->delete();
		}
		return redirect()->action( 'AgencyController@admin');
    }
	
	protected function image_upload( Request $request, $id, $image=null ) 
	{
		$module = 'companies';
		if ( null !== $request->file( 'image' )) {
			$imageName = $module . '-' . $id . '.' . $request->file( 'image' )->getClientOriginalExtension();
			$destinationPath = base_path() . '/public/data/' . $module . '/img';
			$request->file( 'image' )->move( $destinationPath, $imageName );
			$image = $imageName;
		} elseif ( isset( $request->image_delete )) {
			$image = null;
		}
		return $image;
	}
	
	public function remove($company_id, $agency_id)
	{
		$data = AgencyCompany::where('company_id', $company_id)->where('agency_id', $agency_id)->delete();
		return redirect( '/agency/'.$agency_id );
	}
	
	public function dashboardRemove($company_id, $agency_id)
	{
		$data = AgencyCompany::where('company_id', $company_id)->where('agency_id', $agency_id)->delete();
		return redirect( '/dashboard' );
	}
	
	public function addClient($company_id, $agency_id)
	{
		$data = AgencyCompany::create();
		$data['company_id'] = $company_id;
		$data['agency_id'] = $agency_id;	
		$data->save();
		return redirect( '/agency/'.$agency_id );
	}
	
	public function profileUpdate( Request $request, $id )
    {
		$input = \Input::except( array( 'submit', '_token', '_method', 'image', 'image_delete' ));
		$record = Company::find( $id );
		foreach ( $input AS $key => $value ) $record[$key] = $value;
		$record['image'] = $this->image_upload( $request, $id, $record->image );
		$record->save();
		return redirect( '/dashboard' );
    }
	
	public function adCreate($id)
    {
		$data['id'] = $id;
      	return view( 'dashboard.agency.ad_create', $data );
    }
	
	public function storeAd( Request $request, $id )
    {
	    $input = \Input::except( ['image','image_delete'] );
    	$item  = \App\Ad::create( $input );
		$item['company_id'] = $id;
		
		if(empty($item->title)){
		  $item->title = 'Ad-'.$item->id;
		}
      
      	$item->slug = \Str::slug($item->title, '-');
      
      	$item->ad_url = $request->ad_url;
      	$file = $request->file( 'image' );

        if(!empty($file)) {
            $imageName = $item['slug'].'.'.$request->file('image')->getClientOriginalExtension();
            $destinationPath = base_path() . '/public/data/ads/img';
            $request->file('image')->move($destinationPath, $imageName);
            $item['image'] = $imageName;
        }elseif(!empty($request->image_delete)) {
            $item['image'] = null;
        }
      
      	$item->save();
      
        if(empty($item->image)){
          $item->publish_status_id = 0;
          \App\Helpers\Email::newAd($item->company_id);
        }
      
      	$item['category_id'] = $request->category_id;
      
      	$item->save();
		return redirect('/dashboard');
    }
	
	public function authorCreate($id)
    {
		$data['id'] = $id;
      	return view( 'dashboard.agency.author_create', $data );
    }
	
	public function storeAuthor( Request $request, $id )
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
		return redirect('/dashboard');
    }
	
	public function articleCreate($id)
    {
		$data['id'] = $id;
      	return view( 'dashboard.agency.article_create', $data );
    }
	
	public function storeArticle( Request $request, $id )
    {
	    $input = \Input::except(['image']);

		$data = \App\Article::create( $input );
		$data->category_id = $request->input('category_id');
		$file=$request->file('image');
		if (isset($file)){
			$imageName='articles-'. $data->id .'.'.$request->file('image')->getClientOriginalExtension();
			$destinationPath = base_path() . '/public/data/articles/img';
			$request->file('image')->move($destinationPath, $imageName);
			$data->image=$imageName;
		}
		
		$data->slug = \Str::slug($data->title, '-')."-".$data->id;
		$data->save();
		
		if($data->publish_status_id == 1 && $data->status_id != 0){
			$error = \App\Helpers\Email::newArticle($data->id);
		}
		
		//sends mail on new article submission
		//$sendNotify = \App\Helpers\Email::articleSubmitted($data->id);
		$newMess = \App\Helpers\Message::postNew($data->author_id,$data->company_id, 'Article Created - '.$data->title, "Your Article has been created.");
		return redirect('/dashboard');
    }

 	public function videoCreate($id)
    {
        $data['id'] = $id;
      	return view( 'dashboard.agency.video_create', $data );
    }

    public function storeVideo( Request $request, $id )
    {
        $validator = \Validator::make( $request->all(), Video::$rules );
		if ($validator->passes()) {
			$input = \Input::all();
		    $data = \App\Video::create( $input );
            $newMess = \App\Helpers\Message::postNew(
                $data->author_id,$data->company_id, 'Video Created - '.$data->title, "Your video has been created."
            );
            return redirect('/dashboard');
		} else {
				return redirect( 'agency/video/create/' . $id )
				->with( 'message', 'The following errors occurred' )
				->withErrors( $validator )
				->withInput();
		}  			
    }
}

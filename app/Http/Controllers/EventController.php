<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use \App\Event;
use \App\Company;
use \App\Click;
use Str;

class EventController extends Controller
{
	public function __construct()
	{
	}

	public function index( $event_type_id=0 )
	{
		$t = \Carbon\Carbon::now();
		
		if ( $event_type_id == 0 && \Input::get( 'event_type_id' )) $event_type_id = \Input::get( 'event_type_id' );
		$query= Event::with( 'event_type' );
		if ( $event_type_id != 0 ) {
			$query = $query->where( 'event_type_id', $event_type_id );   
			$type = \App\EventType::find($event_type_id);
			$data['type'] = $type->title;
		}
		if ( $search_string = \Input::get( 'search_string' )) {
			$query = $query->where( function( $q ) use ( $search_string ) {
				$q->where( 'title', 'LIKE', '%' . $search_string . '%' )
					->orWhere( 'keywords', 'LIKE', '%' . $search_string . '%' );
			});
		}
		$data['items'] = $query->where( 'status_id', 0 )
			->where( 'ends_at','>=', $t )
			->orderBy( 'starts_at' )
			->get();
		$data[ 'event_type_id' ] = $event_type_id;
		$data[ 'search_string' ] = $search_string;
		return view( 'event.index', $data );
	}

	public function admin($status = 0)
	{
		$checked = \App\Helpers\Status::checkEvents();
		$data['events'] = Event::where('status_id',$status )
			->with( 'event_type', 'status' )
			->orderBy( 'starts_at' )
			->get();
		$data['export'] = Event::where('status_id', $status )
			->select('id', 'email', 'title', 'location', 'url', 'first_name', 'last_name', 'contact_title', 'company_name_sub','phone', 'contact_email', 'starts_at', 'ends_at')
			->orderBy( 'starts_at' )
			->get();
		$data['status'] = $status;
		$data['checked'] = $checked;
		$data['export']['reportName'] = "Events_Information";
		$data['alert'] = $checked." Record(s) Deactivated";
		return view( 'event.admin', $data );
	}

	public function company( $id=0, $status=0 )
	{
		if ( $id == 0 || \Auth::user()->role != 'admin' )
		$id = \Auth::user()->company_id;
		$checked = \App\Helpers\Status::checkEvents();
		$data['events'] = Event::where('status_id',$status )
			->where( 'company_id', $id )
			->where( 'ends_at','>=', \Carbon\Carbon::now() )
			->where( 'starts_at','<=', \Carbon\Carbon::now() )
			->with( 'event_type', 'status' )
			->orderBy( 'starts_at' )
			->get();
		$data['status'] = $status;
		$data['company'] = Company::find( $id );
		return view( 'event.company', $data );
	}

	public function show($id)
	{
		Click::set( 'event', $id );
		$data = Event::with( 'event_type' )->find( $id );
		return view( 'event.show', $data );
	}
	
	public function view($slug)
	{
		$data = Event::where('slug', $slug)->with( 'event_type' )->first();
		Click::set( 'event', $data->id );
		return view( 'event.show', $data );
	}

	public function acreate()
	{
		return view( 'event.admin_create' );
	}
	
	public function create()
	{
		return view( 'event.create' );
	}

	public function store(Request $request)
	{
		$validator = \Validator::make( $request->all(), Event::$rules, Event::$messages );
		if ( $validator->passes() ) {
			// save fields
			$input = \Input::except( array( 'submit', '_token', '_method', 'image', 'image_delete' ));
			$input['starts_at'] = \Carbon\Carbon::parse($input['starts_at'])->format('Y-m-d');
			if(!empty( $input['ends_at'] )) $input['ends_at'] = \Carbon\Carbon::parse($input['ends_at'])->format('Y-m-d');
			if ( empty( $input['ends_at'] )) $input['ends_at'] = $input['starts_at'];
			$item = Event::create( $input );
			$item['slug'] = \Str::slug($item->title, '-');
			$item->save();
			// upload file
			$file = \Input::file( 'image' );
			if ( !empty( $file )) {
				$imageName = 'events-' . $item->id . '.' . $request->file('image')->getClientOriginalExtension();
				$path = base_path() . '/public/data/events/img';
				$file->move( $path, $imageName );
				$item->image = $imageName;
				$item->save();
			}
			return redirect( '/events/' . $item->id );
		} else {
			return redirect( 'events/create' )
				->with( 'message', 'The following errors occurred' )
				->withErrors( $validator )
				->withInput();
		}
	}

	public function edit($id)
	{
		$data['event'] = Event::find( $id );
		return view( 'event.edit', $data );
	}

	public function update(Request $request, $id)
	{
		$input = \Input::except( array( 'submit', '_token', '_method', 'image', 'image_delete' ));
		$record = Event::find( $id );
		
		foreach ( $input AS $key => $value ) $record[$key] = $value;
		$record['starts_at'] = \Carbon\Carbon::parse($request->starts_at)->format('Y-m-d');
		if ( empty( $record->ends_at )){
			$record['ends_at'] = \Carbon\Carbon::parse($request->starts_at)->format('Y-m-d');	
		}else{
			$record['ends_at'] = \Carbon\Carbon::parse($request->ends_at)->format('Y-m-d');	
		}		
		$record['slug'] = Str::slug($record->title, '-');
		$record->save();
		// upload file
		$file = \Input::file( 'image' );
		if ( !empty( $file )) {
			$imageName = 'events-' . $record->id . '.' . $request->file('image')->getClientOriginalExtension();
			$path = base_path() . '/public/data/events/img';
			$file->move( $path, $imageName );
			$record->image = $imageName;
			$record->save();
		} elseif ( isset( $request->image_delete )) {
			$record['image'] = null;
			$record->save();
		}

		$record->preview = true;
		return redirect( '/events/' . $id );
	}

	public function destroy($id)
	{
		$data= Event::find($id);
		$data->delete();
		return redirect( '/events' );
	}

	public function remove(Request $request)
	{
		$event = Event::find($request->input('event_id'));
		$event->delete();
		return redirect( '/events/admin' );
	}
	
	public function updateSlug(){
    $ads = Event::all();
    foreach($ads as $ad){
      $ad->slug = \Str::slug($ad->title, '-');
      $ad->save();
    }
    
    return redirect('/events');
  }
}

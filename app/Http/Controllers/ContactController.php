<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Mail;

use \App\Contact;
use \App\ContactReason;
use \App\Setting;

class ContactController extends Controller
{
	public function __construct() {
        //$this->middleware( 'auth', [ 'except' => [ 'create', 'store' ]]);
        // $this->beforeFilter( 'csrf', array( 'on'=>'post' ));
    }

    public function index()
    {
		$data['contacts'] = Contact::orderBy( 'id', 'DESC' )->where('status_id','=','0')->take(200)->get();
			
		return view( 'contact.index', $data );
    }
    
    public function postIndex(Request $request)
    {
    	$contacts = Contact::orderBy( 'id', 'DESC' );
			if(!\Input::has('show_inactive'))
			{
				$contacts->where('status_id','=','0');
			}
			$data['contacts'] = $contacts->take(200)->get();
			$data['request'] = $request;	
			return view( 'contact.index', $data );
    }

    public function create()
    {
			$data['item'] = new Contact();
			return view( 'contact.create', $data );
    }
	
    public function store( Request $request )
    {
			$validator = \Validator::make( $request->all(), Contact::$rules );
			if ($validator->passes()) {
				$input = \Input::all();
				$data = Contact::create( $input );
				$data->save();
				$users = \App\User::where('role','=','admin')->get(); 
				foreach($users as $user) {
					\Mail::send('emails.contact', ['user' => $user], function ($m) use ($user) {
						$m->from('info@i95business.com', 'I-95 Business');
						$m->to($user->email, $user->first_name.' '.$user->last_name)->subject('Contact form submitted');
					});
				}
				return redirect( '/' )->with('message', 'Your Contact Us request has been submitted.');
			} else {
				return redirect('/contact-us')->withErrors($validator)->withInput();
			}
	
		}
	
	protected function send_email( $contact ) 
	{
		$settingsContact = Setting::where( 'type', '=', 'contact ')->pluck( 'body', 'slug' );
		Mail::send( 'emails.contact', 
			[
				'name' => $contact->name, 
				'email' => $contact->email, 
				'phone' => $contact->phone, 
				'comments' => $contact->comments ],
			function($message) use ( $settingsContact )
			{
				$message->to( $settingsContact['contact-email-to'], 'Surgication Contact Admin' );
				$message->from( $settingsContact['contact-email-from'], 'Surgication Site Admin' );
				$message->cc( $settingsContact['contact-email-cc'], 'Surgication Contact CC' );	
				$message->subject( 'Surgication Contact Request' );
			});
	}
	
    public function show($id)
    {
        $data['contact'] = Contact::with( 'status' )->find( $id )->first();
        return view( 'contact.show', $data );
    }

    public function edit($id)
    {
        $data['contact'] = Contact::with( 'status' )->find( $id )->first();
        return view( 'contact.edit', $data );
    }

    public function update(Request $request, $id)
    {
			$input = \Input::except( array( 'submit', '_token', '_method' ));
			$record = Contact::find( $id )->first();
			foreach ( $input AS $key => $value ) {
				$record[$key] = $value;
			}
			$record->save();
			return view( 'contact.show', array( 'contact' => $record ));  
    }

    public function destroy($id)
    {
        //
    }
}

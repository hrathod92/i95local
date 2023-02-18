<?php

namespace App\Http\Controllers;

use App\Account;
use App\User;
use App\Role;

use Illuminate\Http\Request;
use App\Http\Requests;

use Mail;
use Session;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Controller\Auth;

class UserController extends BaseController {

	protected $layout = "templates.default";

	public function __construct() {
		$this->middleware( 'auth', [ 'except' => [ 
			'getLogin', 
			'postLogin', 
			'getCreate', 
			'postCreate', 
			'getCreateConfirm',
			'getRegister',
			'getPassword', 
			'postPassword', 
			'getReset',
			'postReset'
		]]);
		
		$this->middleware( 'role:admin', [ 'only' => [ 'getIndex' ]]);
		$this->middleware( 'site' );
		$this->beforeFilter( 'csrf', array( 'on'=>'post' ));
		$this->user = \Auth::user();
	}

	public function getIndex($status=0) {
		$data['users'] = User::with( 'user_status', 'company' )
			->where('user_status_id', $status)
			->orderBy( 'last_name' )
			->orderBy( 'first_name' )
			->get();
		$data['status'] = $status;
		return view( 'user.index', $data );
	}

	public function getView( $id=1 ) {
		if( ($this->user->id == $id ) || ($this->user->role == "admin") ) {
			$data = User::with( 'user_status' )->find( $id );
			return view( 'user.view', $data );
		}
		else {
			return redirect("dashboard");
		}
	}
	
	public function getAccount() {
		if( isset( \Auth::user()->id )) {
			$data = User::with( 'user_status' )->find( \Auth::user()->id );
			$data['param_array'] = json_decode( $data->params );
			return view( 'user.account', $data );
		}
		else {
			return redirect("/");
		}
	}

	public function getEdit( $id=1 ) {
		if( ($this->user->id == $id ) || ($this->user->role == "admin") )
		{
			$data['user'] = User::find( $id );
			return view( 'user.edit', $data );
		} else {
			return redirect("dashboard");
		}
	}

	public function postEdit($id, Request $request) {
		if( ($this->user->id == $id ) || ($this->user->role == "admin") ) {

			$user = User::find( $id );
			$emailOld = $user->email;
			$input = $request->except( array( 'submit', '_token' ));
			foreach ( $input AS $key => $value ) {
				$user[$key] = $value;
			}
			$user->save();
			if ( $user->email != $emailOld ) {
				$this->send_email_email( $user->email, $user->email, $emailOld );
				$this->send_email_email( $emailOld, $user->email, $emailOld );
			}
			return redirect( 'user/view/' . $id );

		} else {
			return redirect("dashboard");
		}
	}
	
	protected function send_email_email( $email, $email_new, $email_old )
    {
		Mail::send( 'emails.email_change', 
			[
				'email' => $email_new,
				'email_old' => $email_old
			], 
			function ( $message ) use ( $email )
			{
				$message->to( $email );
				$message->from( 'admin@cantongroup.com', 'Admin' );
				$message->cc( 'admin@cantongroup.com', 'Admin' );	
				$message->subject( 'Email Change' );
			}
		);
	}
	
	public function getCreate()
    {
		return view('user.create' );
	}

	public function postCreate(Request $request) {		
		$register = new \App\Register;
	
		$validator_register = \Validator::make( $request->all(), $register::$rules_register );
		if ($validator_register->passes()) {
			$validator = \Validator::make( $request->all(), User::$rules );
			if ($validator->passes()) {
				$register = new \App\Register;
				$register->first_name = $request->input('first_name');
				$register->last_name = $request->input('last_name');
				$register->email = $request->input('email');
				$password = base64_encode(openssl_random_pseudo_bytes(10));
				$register->password = \Hash::make($password);
				$role = $request->input( 'role' );
				$register->role = isset( $role ) ? $role : 'user';
				$register->company_id = $request->input('company_id');
				$register->phone = $request->input('phone');
				$register->token = '12345';
				$register->status = 'new';
				$register->save();
				$this->send_email( $register, $password );
				return redirect( 'user/create_confirm')->with('email_msg', $register->email);
			} else {
				return redirect('user/create')->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
			}

		} else {
			return redirect('user/create')->with('message', 'The following errors occurred')->withErrors($validator_register)->withInput();
		}

	}
	
	protected function send_email( $register, $password ) {
		Mail::send( 'emails.register', 
			['first_name' => $register->first_name,
			 'last_name' => $register->last_name, 
			 'email' => $register->email,
			 'id' => $register->id,
			 'password' => $password
			], 
			function( $message ) use ( $register )
			{
				$message->to( $register->email, $register->first_name . ' ' . $register->last_name );
				$message->from( 'admin@cantongroup.com', 'Registration' );	
				$message->subject( 'Registration' );
			});
	}
	
	public function getCreateConfirm() {
		return view('user/create_confirm' );
	}
	
	public function getRegister( $id ) {
		$register = \App\Register::find( $id );
		$register->status = 'created';
		$register->save();
		$registerArray = (array) $register;
		unset( $register['token'] );
		unset( $register['status'] );
		$user = new User( $register->toArray() );
		$user->save();
		return view( 'user/register', $user );
	}
	
	public function getLogin( Request $request ) {
		return view( 'user.login' );
	}

	public function postLogin() 
	{
		if ( \Auth::attempt( array( 'email'=>\Input::get('email'), 'password'=>\Input::get('password'), 'user_status_id' => 0 ))) 
		{
			return redirect('/dashboard');
		} 
		else 
		{
			$uri = '/user/login';
			return redirect($uri)
				->with( 'message', 'Your username/password combination was incorrect' )
				->withInput();
		}
	}

	public function getLogout() {
		$uri = '/';
		\Auth::logout();
		return redirect( $uri )->with( 'message', 'You are now logged out!' );
	}

	public function getPassword() {
		return view( 'user.password' );
	}
	
	public function postPassword() {
		$email = \Input::get( 'email' );
		if ( $user_id = User::where( 'email', '=', $email )->pluck( 'id' ) ) {
			$token = '12345';
			$reset = \App\Reset::create();
			$reset->user_id = $user_id;
			$reset->email = $email;
			$reset->token = $token;
			$reset->save();
			$this->send_email_password( $email, $user_id, $token );
			return view( 'user.password_confirm' );			
		} else {
				if ($email == "") {
					return view( 'user.password' )->with( 'message', 'Please enter an email address.' );
				} else {	
					return view( 'user.password' )->with( 'message', 'The requested account (email) does not exist.' );
				}
		}
	}
	
	protected function send_email_password( $email, $user_id, $token ) {
		Mail::send( 'emails.password', 
			[
				'email' => $email,
				'user_id' => $user_id,
				'token' => $token 
			], 
			function ( $message ) use ( $email )
			{
				$message->to( $email );
				$message->from( 'admin@i95business.com', 'i95 Business Admin' );
				$message->cc( 'admin@i95business.com', 'i95 Business Admin' );	
				$message->subject( 'i95 Business Password Reset Request' );
			}
		);
	}
	
	public function getReset( $id ) {
		$data['id'] = $id;
		return view( 'user.reset', $data );
	}
	
	public function postReset() {
		$validator = \Validator::make( \Input::all(), User::$rules_password );
		if  ($validator->passes() ) {
			$user = User::find( \Input::get( 'id' ));
			$user->password = \Hash::make( \Input::get( 'password' ));
			$user->save();
			return view( 'user.reset_confirm' );
		} else {
			$data['id'] = \Input::get( 'id' );
			return view( 'user.reset', $data )->withErrors( $validator );
		}
	}

	public function getPendingRegistrations()
	{
		$data['registrations'] = \App\Register::whereRaw('registers.email NOT IN (SELECT email FROM users)')->get();
		
		return view('user.pending_registrations', $data);
	}
	
	public function sendRegistrationEmail(Request $request)
	{
		$register = \App\Register::find($request->input('id'));
		
		$password = base64_encode(openssl_random_pseudo_bytes(10));
		$register->password = \Hash::make($password);
			
		$register->save();
		
		$this->send_email( $register, $password );
		
		return redirect('/pending-registrations')->with('message','Email sent to registrant');
	}

}

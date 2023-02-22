<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Carbon\Carbon;

use \App\Job;
use App\JobType;
use \App\JobCapturedEmail;
use \App\Company;
use \App\Click;

class JobController extends Controller
{
	public function __construct()
	{
		$publicMethods = [
				'index',
				'show',
				'create',
			  'store',
				'getEmailRequired',
				'postEmailRequired'
		];
		$this->middleware( 'auth', ['except' => $publicMethods] );
	}

	public function index( $job_type_id=0 )
	{
		if ( $job_type_id == 0 && \Input::get( 'job_type_id' )) $job_type_id = \Input::get( 'job_type_id' );
		
		$query = Job::with( 'job_type', 'company' )->where( 'status_id', 0 );
		
		if ( $job_type_id != 0){
			$query = $query->where( 'job_type_id', $job_type_id );
			$type = \App\JobType::find($job_type_id)->first();
			$data['type'] = $type->title;
		}

		if ( $search_string = \Input::get( 'search_string' )) $query = $query->where( 'job_title', 'LIKE', '%' . $search_string . '%' );
		$expDays = \App\Setting::where( 'slug', 'jobs-expiration' )->pluck( 'body' )->first();
		$expDate = Carbon::now()->subDays( $expDays );
		$data['items'] = $query->where( 'created_at', '>=', $expDate )
			->orderBy( 'id', 'DESC' )
			->get();
		$data[ 'job_type_id' ] = $job_type_id;
		$data[ 'search_string' ] = $search_string;
		return view( 'job.index', $data );
	}

	public function admin()
	{
		$data['jobs'] = Job::with( 'job_type', 'company' )
			->orderBy('id', 'desc')
			->get();
		$data['export'] = Job::select('job_title', 'location', 'company_name', 'company_url', 'contact_info', 'title','first_name','last_name','phone','contact_email','email')
			->orderBy('id', 'desc')
			->get();
		$data['export']['reportName'] = "Job_Board_Information";
		return view('job.admin', $data);
	}
	
	public function emails()
	{
		$data['items'] = JobCapturedEmail::orderBy('id', 'desc')->get();
        $data['export'] = JobCapturedEmail::select('created_at', 'email')->orderBy('id', 'desc')->get();
        $data['export']['reportName'] = "Job_Board_Email_Information";
		return view( 'job.emails', $data );
	}
	
	public function company( $id=0 )
	{
		if ( $id == 0 || \Auth::user()->role != 'admin ') $id = \Auth::user()->company_id;
		$data['jobs'] = Job::with( 'job_type', 'company' )
			->where( 'company_id', $id )
			->orderBy('id', 'desc')
			->get();
		$data['company'] = Company::find( $id )->first();
		return view('job.company', $data);
	}

	public function show( $id )
	{
		Click::set( 'job', $id );
		if( isset( \Auth::user()->id ) || session()->get( 'job-email' ) != '' ) {
			$data['item'] = Job::find( $id )->first();
			return view('job.show', $data);
		} else {
			session([ 'current-job-id' => $id ]);
			return view('job.email_required');
		}      
	}
	
	public function postEmailRequired()
	{
		$email = \Input::get( 'email' );
		$id = session()->get( 'current-job-id' );
		$validator = \Validator::make( \Input::all(), Job::$rules_email );
		if ( $validator->passes() ) {
			if ( $email != session()->get( 'job-email' )) {
				session([ 'job-email' => $email ]);
				$captured_email = \App\JobCapturedEmail::create();
				$captured_email->email = $email;
				$captured_email->save();
			}	
			$item = Job::find( $id )->first();
			return redirect()->route('jobs.show', $item );
		} else {
			return view( 'job.email_required' )->with( 'message', 'Please enter a valid email address.' );
		}
	}

	public function create()
	{
		return view('job.create');
	}

	public function store( Request $request )
	{
		$item = Job::create($request->all());
		return redirect()->route('jobs.show', $item->id );
	}

	public function edit( $id )
	{
		$data['item'] = Job::find( $id )->first();
		return view('job.edit', $data);
	}

	public function update( Request $request, $id )
	{
		$input = \Input::except( array( 'submit', '_token', '_method' ));
		$record = Job::find( $id )->first();
		foreach ( $input AS $key => $value ) $record[$key] = $value;
		$record->save();
		$record->preview = true;
		return redirect()->route('jobs.show', $record->id );
	}

}

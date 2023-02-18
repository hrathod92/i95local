<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\JobType;

class JobTypeController extends Controller
{
    public function __construct()
    {
        $publicMethods = [
            'show',
        ];

        $this->middleware('auth', ['except' => $publicMethods]);
    }

    public function admin()
    {
        $data = [
            'items' => JobType::all(),
        ];
        return view('job-type.admin', $data);
    }

    public function create()
    {
        return view('job-type.create');
    }

    public function store(Request $request)
    {
				$validator = \Validator::make( \Input::all(), JobType::$rules_job_type );
		    if  ($validator->passes() ) {
          $item = JobType::create($request->all());
          return redirect()->route('job-types.admin', $item);
		    } else {
					return view('job-type.create')->with( 'message', 'Please enter a Job Type.' );
		    }
    }

    public function show(JobType $job)
    {
        $data = [
            'item' => $job,
            'jobTypes' => JobType::all()
        ];
        return view('job-type.show', $data);
    }

    public function edit(JobType $item)
    {
        $data = [
            'item' => $item,
        ];
        return view('job-type.edit', $data);
    }

    public function update(Request $request, JobType $item)
    {
        $item->fill($request->all());
        $item->save();
        return redirect()->route('job-types.admin', $item);
    }

    public function destroy(JobType $item)
    {
        //
    }
}

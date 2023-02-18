<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'jobs';
    protected $morphClass = 'job';
    protected $fillable = [
        'status_id',
        'job_type_id',
        'job_title',
        'company_id',
        'company_url',
				'company_name',
        'description',
				'first_name',
				'last_name',
				'title',
				'company_name_sub',
				'phone',
				'email',
				'agree'
//         'contact_info',
//         'location'
    ];

    public function job_type() { return $this->belongsTo( JobType::class ); }
    public function company() { return $this->belongsTo( Company::class );}
    public function status() { return $this->belongsTo( Status::class ); }
  
	  public function click() { return $this->morpOne( 'App\Click', 'clickable' ); }

    public static $rules_email = array(
        'email'  => 'required|email',
    );

}

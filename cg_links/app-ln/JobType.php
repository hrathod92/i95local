<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobType extends Model
{
    protected $table = 'job_types';
    protected $fillable = [ 'title'];
    public $timestamps = false;

    public static $rules_job_type = array(
        'title'  => 'required',
    );

}





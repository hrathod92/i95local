<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobCapturedEmail extends Model
{
    protected $table = 'jobs_captured_emails';

    protected $fillable = [
        'email'
    ];

}

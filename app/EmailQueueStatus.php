<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailQueueStatus extends Model
{
	protected $table = 'email_queue_statuses';
	protected $fillable = ['title'];
	public $timestamps = false;
}

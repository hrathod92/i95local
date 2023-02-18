<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
	protected $table = 'feeds';
	protected $fillable = [ 'status_id', 'title', 'body', 'embed' ];
	public $timestamps = false;
}

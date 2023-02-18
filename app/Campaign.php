<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
	protected $table = 'campaigns';
	protected $fillable = [ 'status_id', 'title', 'body', 'image' ];
	public $timestamps = true;
}

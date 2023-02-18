<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reset extends Model
{
	protected $table = 'resets';
	protected $fillable = [ 'user_id', 'email', 'token', 'status' ];
	public $timestamps = true;
}

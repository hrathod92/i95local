<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
	protected $table = 'accounts';
	protected $fillable = [ 'status_id', 'title', 'body', 'price', 'image' ];
	public $timestamps = true;
}

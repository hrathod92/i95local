<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
	protected $table = 'statuses';
	protected $fillable = ['title'];
	public $timestamps = false;

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dow extends Model
{
	protected $table = 'dows';
	protected $guarded = ['id'];
	public $timestamps = true;
}

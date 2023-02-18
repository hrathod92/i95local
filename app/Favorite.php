<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
	protected $table = 'favorites';
	protected $guarded = ['id'];
	public $timestamps = false;
}

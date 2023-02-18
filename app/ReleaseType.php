<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReleaseType extends Model
{
	protected $table = 'release_types';
	protected $fillable = ['title'];
	public $timestamps = false;
}

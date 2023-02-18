<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdType extends Model
{
	protected $table = 'ad_types';
	protected $fillable = [ 'slug', 'title' ];
	public $timestamps = false;
}

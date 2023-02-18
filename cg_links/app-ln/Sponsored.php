<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsored extends Model
{
	protected $table = 'sponsoreds';
	protected $fillable = [ 'status_id', 'title', 'body', 'image' ];
	public $timestamps = true;
}

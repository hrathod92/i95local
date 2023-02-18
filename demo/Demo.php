<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Demo extends Model
{
	protected $table = 'demos';
	protected $fillable = [ 'status_id', 'title', 'body', 'price', 'image' ];
	public $timestamps = true;
}

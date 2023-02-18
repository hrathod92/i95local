<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
	protected $table = 'blocks';
	protected $fillable = [ 'type', 'slug', 'class', 'title', 'body', 'image' ];
	public $timestamps = true;
}

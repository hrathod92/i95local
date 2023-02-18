<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
	protected $table = 'menus';
	protected $fillable = [ 'slug', 'title', 'body' ];
	public $timestamps = true;
}

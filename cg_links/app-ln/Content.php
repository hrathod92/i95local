<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
	protected $table = 'contents';
	protected $fillable = [ 'slug', 'ad_show_id', 'status_id', 'title', 'body', 'image', 'sidebar' ];
	public $timestamps = true;
	
	public static $rules = array(
		'slug'  => 'required|min:3|unique:contents,slug',
		'title'  => 'required|min:6',
	);

}

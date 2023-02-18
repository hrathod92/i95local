<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $table = 'categories';
	protected $guarded = ['id'];
	public $timestamps = false;
	
	public function getTitleAttribute($value) {
			return ucwords($value);
	}
	
	public function parent() { return $this->belongsTo( 'App\Category', 'parent_id' ); }
	public function category_level() { return $this->belongsTo( 'App\CategoryLevel', 'level' ); }
	public function status() { return $this->belongsTo( 'App\Status' ); }
}

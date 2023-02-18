<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryLevel extends Model
{
	protected $table = 'category_levels';
	protected $fillable = ['title'];
	public $timestamps = false;

}

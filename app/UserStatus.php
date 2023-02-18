<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserStatus extends Model
{
	protected $table = 'user_statuses';
	protected $fillable = ['title'];
	public $timestamps = false;
	public function user_status() { return $this->hasMany('App\User'); }
}

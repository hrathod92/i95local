<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
	protected $table = 'registers';
	protected $fillable = [ 'email', 'password', 'token', 'status' ];
	public $timestamps = true;

	public static $rules_register = array(
      'email'  => 'required|email|unique:registers,email'
  );

}

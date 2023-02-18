<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
	protected $table = 'contacts';
	protected $guarded = [ 'id', 'g-recaptcha-response' ];
	public $timestamps = true;

	public function status() { return $this->belongsTo('App\Status' ); }

	public static $rules = array(
		'g-recaptcha-response' => 'required|recaptcha',
		'name'  => 'required',
    'email'  => 'required|email',
    'company_email'  => 'email'
  );

}

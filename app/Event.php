<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
	protected $table = 'events';
	protected $guarded = [ 'id' ];
	public $timestamps = false;

	public static $rules = [
		'title' => 'required',
		'email' => 'required|email',
		'starts_at' => 'required',
		'agree' => 'required',
		'image'=> 'mimes:jpeg,bmp,png',
	];
	
	public static $messages = [
		'title.required' => 'Event title is required.',
		'email.required' => 'Submitter email is required.',
		'starts_at.required' => 'Event (start) date is required.',
		'agree.required' => 'You must accept terms and conditions agreement.',
		'image.mimes'=> 'Image must be a JPG, PNG or GIF.'
	];
	
	public function event_type() { return $this->belongsTo( 'App\EventType' ); }
	public function status() { return $this->belongsTo( 'App\Status' ); }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
	protected $table = 'messages';
	protected $fillable = [ 'message_type_id','status_id', 'company_id', 'title', 'body', 'image' ];
	public $timestamps = true;
	
  	public function message_type() { return $this->belongsTo( 'App\MessageType' ); }
	public function company() { return $this->belongsTo( 'App\Company' ); }
}

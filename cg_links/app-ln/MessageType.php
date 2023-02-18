<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageType extends Model
{
	protected $table = 'message_types';
	protected $fillable = ['title'];
	public $timestamps = false;
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventType extends Model
{
	protected $table = 'event_types';
	protected $fillable = ['title'];
	public $timestamps = false;
}

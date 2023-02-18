<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
	protected $table = 'faqs';
	protected $fillable = [ 'status_id', 'type', 'refno', 'title', 'body' ];
	public $timestamps = true;
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
	protected $table = 'authors';
	protected $fillable = [ 'status_id', 'company_id', 'title', 'body', 'image' ];
	public $timestamps = true;
	
  public function company() { return $this->belongsTo( 'App\Company' ); }
  public function status() { return $this->belongsTo( 'App\Status' ); }
}

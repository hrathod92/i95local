<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
	protected $table = 'newsletters';
	protected $fillable = [ 'status_id', 'title', 'body', 'image', 'document', 'newsletter_year'];
	public $timestamps = true;
	
  public function newsletter_year() { return $this->belongsTo( 'App\NewsletterYear' ); }
  public function status() { return $this->belongsTo( 'App\Status' ); }

}

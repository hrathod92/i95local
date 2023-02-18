<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Release extends Model
{
	protected $table = 'releases';
	protected $guarded = [ 'id' ];
	public $timestamps = true;
	
  public function status() { return $this->belongsTo( 'App\Status' ); }
  public function release_type() { return $this->belongsTo( 'App\ReleaseType' ); }
  public function company() { return $this->belongsTo( 'App\Company' ); }
	
	public function scopeSearch( $query, $searchString )
	{
		return $query->where( 'title', 'LIKE', '%' . $searchString . '%' );
	}
	
}

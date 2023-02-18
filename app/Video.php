<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
	protected $table = 'videos';
	protected $fillable = [ 'company_id', 'status_id', 'video_type_id', 'title', 'body', 'embed', 'youtube_video_id', 'keywords'];
	public $timestamps = true;
	
  public function video_type() { return $this->belongsTo( 'App\VideoType' ); }
  public function status() { return $this->belongsTo( Status::class ); }
  public function favorite() { return $this->belongsTo( Favorite::class ); }
  public function company() { return $this->belongsTo( Company::class ); }
	
	public static $rules = array(
		'title'  => 'required',
		'embed'  => 'required',
		'youtube_video_id'  => 'required'
	);

	public function scopeSearch( $query, $searchString )
	{
		return $query->where( 'title', 'LIKE', '%' . $searchString . '%' );
	}
	
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Click extends Model
{
	protected $table = 'clicks';
	protected $fillable = [ 'type', 'item_id', 'company_id', 'action', 'click_count' ];
	public $timestamps = true;
	
  public function company() { return $this->belongsTo( 'App\Company' ); }
	
	public function clickable() { 
		return $this->morphTo( 'clickable', 'clickable_type', 'clickable_id' ); 
	}
	
	public static function set( $type, $item_id )
	{
		$id = self::where( 'clickable_type', $type )->where( 'clickable_id', $item_id )->pluck( 'id' );
		if ( !empty( $id )) {
			$record = Click::find( $id );
			$record->click_count += 1;
		} else {
			$record = self::create();
			$record['clickable_type'] = $type;
			$record['clickable_id'] = $item_id;
			$record['click_count'] = 1;
		}

		//find company_id who is currently associated with the content that was viewed/clicked on
		if ($type === 'article-read' || $type === 'article-contact' || $type === 'article') {
			$company_id = Article::where( 'id', $item_id )->pluck( 'company_id' );
		}	
		elseif ($type === 'event'){
			$company_id = Event::where( 'id', $item_id )->pluck( 'company_id' );
		}	
		elseif ($type === 'ad'){
			$company_id = Ad::where( 'id', $item_id )->pluck( 'company_id' );
		}
		elseif ($type === 'job'){
			$company_id = Job::where( 'id', $item_id )->pluck( 'company_id' );
		}
		elseif ($type === 'video'){
			$company_id = Video::where( 'id', $item_id )->pluck( 'company_id' );
		}

		//associate the click instance to the company
		if(!empty($company_id) && $company_id > 0){
			$record['company_id'] = $company_id;
		}
		
		$record->save();
		return redirect( '/clicks' );  
	}
	
	public static function get( $type, $item_id, $action='' ) {
		$clicks = self::where( 'clickable_type', $type )
			->where( 'clickable_id', $item_id )
			->where( 'action', $action )
			->pluck( 'click_count' );
		if ( $clicks > 0 )
			return $clicks;
		else
			return 0;
	}

}

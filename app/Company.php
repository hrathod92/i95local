<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
	protected $table = 'companies';
	protected $fillable = [ 'status_id', 'title', 'body', 'image', 'image_delete', 'category_id' , 'category_2_id' , 'category_3_id' , 'company_type_id' , 'contact_us_url', 'keywords', 'slug' ];
	public $timestamps = true;
	
  public function category() { return $this->belongsTo( 'App\Category', 'category_id' ); }
  public function category2() { return $this->belongsTo( 'App\Category', 'category_2_id'); }
  public function category3() { return $this->belongsTo( 'App\Category', 'category_3_id'); }
  public function company_type() { return $this->belongsTo( 'App\CompanyType', 'company_type_id' ); }
  public function status() { return $this->belongsTo( 'App\Status', 'status_id' ); }
  public function scopeSearch( $query, $searchString ) {
    return $query->where( 'title', 'LIKE', '%' . $searchString . '%' );
  }
	
	public function getCatWithAnchor() {
		$cat = '<a href="/articles/category/' . $this->category['slug'] . '">' . $this->category['title'] . '</a>';
		return $cat;
	}
	
	public function getCatStrWithAnchors() {
		$cat = '<a href="/articles/category/' . $this->category['slug'] . '">' . $this->category['title'] . '</a>';
		if ( isset( $this->category_2_id ) && $this->category_2_id != 0 )
			$cat .= ' | <a href="/articles/category/' . $this->category2['slug'] . '">' . $this->category2['title'] . '</a>';
		if ( isset( $this->category_3_id ) && $this->category_3_id != 0 )
			$cat .= ' | <a href="/articles/category/' . $this->category3['slug'] . '">' . $this->category3['title'] . '</a>';
		return $cat;
	}
	
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Click;

class Article extends Model
{
	protected $table = 'articles';
	protected $morphClass = 'article';
	protected $fillable = [ 
		'status_id',
		'publish_status_id',
		'company_id', 
		'author_id',
		'newsletter_id',
		'category_id', 
		'title', 
		'body', 
		'image', 
		'video',
		'video_id',
		'featured_id',
		'slug',
		'top_id', 
		'more_id',
		'pub_date',
		'tagline',
		'keywords',
		'category_2_id',
		'category_3_id',
		'category_4_id',
		'category_5_id',
		'image_width',
		'image_caption',
		'general_caption',
		'meta_description',
	];
	public $timestamps = true;
	
  public function company() { return $this->belongsTo( 'App\Company' ); }
  public function author() { return $this->belongsTo( 'App\Author' ); }
  public function status() { return $this->belongsTo( 'App\Status' ); }
  public function publish_status() { return $this->belongsTo( 'App\PublishStatus' ); }
  public function category() { return $this->belongsTo( 'App\Category', 'category_id' ); }
  public function category2() { return $this->belongsTo( 'App\Category', 'category_2_id' ); }
  public function category3() { return $this->belongsTo( 'App\Category', 'category_3_id' ); }
  public function category4() { return $this->belongsTo( 'App\Category', 'category_4_id' ); }
  public function category5() { return $this->belongsTo( 'App\Category', 'category_5_id' ); }
	public function favorite() { return $this->belongsTo( 'App\Favorite' ); }
	public function top() { return $this->belongsTo( 'App\Favorite' ); }
	public function more() { return $this->belongsTo('App\BoolWTF'); }
	
	public function click() { return $this->morphOne( 'App\Click', 'clickable' ); }
	
	public function getCatWithAnchor() {
		$cat = '<a href="/articles/category/' . $this->category['slug'] . '">' . $this->category['title'] . '</a>';
		return $cat;
	}
	
	public function getCatStrWithAnchors() {
		$cat = '<a href="/articles/category/' . $this->category['slug'] . '">' . $this->category['title'] . '</a>';
		if ( isset( $this->category_2_id ) && $this->category_2_id != 0 && isset($this->category2['slug']))
			$cat .= ' | <a href="/articles/category/' . $this->category2['slug'] . '">' . $this->category2['title'] . '</a>';
		if ( isset( $this->category_3_id ) && $this->category_3_id != 0 && isset($this->category3['slug']))
			$cat .= ' | <a href="/articles/category/' . $this->category3['slug'] . '">' . $this->category3['title'] . '</a>';
		return $cat;
	}
	
	public function get5CatStrWithAnchors() {
		$cat = '<a href="/articles/category/' . $this->category['slug'] . '">' . $this->category['title'] . '</a>';
		if ( isset( $this->category_2_id ) && $this->category_2_id != 0 && isset($this->category2['slug']))
			$cat .= ' | <a href="/articles/category/' . $this->category2['slug'] . '">' . $this->category2['title'] . '</a>';
		if ( isset( $this->category_3_id ) && $this->category_3_id != 0 && isset($this->category3['slug']))
			$cat .= ' | <a href="/articles/category/' . $this->category3['slug'] . '">' . $this->category3['title'] . '</a>';
		if ( isset( $this->category_4_id ) && $this->category_4_id != 0 && isset($this->category4['slug']))
			$cat .= ' | <a href="/articles/category/' . $this->category4['slug'] . '">' . $this->category4['title'] . '</a>';
		if ( isset( $this->category_5_id ) && $this->category_5_id != 0 && isset($this->category5['slug']))
			$cat .= ' | <a href="/articles/category/' . $this->category5['slug'] . '">' . $this->category5['title'] . '</a>';
		return $cat;
	}
	
	public function getClicksAttribute()
	{
		return Click::get( 'article', $this->id );
	}
	
	public function scopeSearch( $query, $searchString )
	{
		return $query->where( function( $query ) use ( $searchString ) {
			$query->where( 'articles.title', 'LIKE', '%' . $searchString . '%' )
				->orWhere( 'articles.keywords', 'LIKE', '%' . $searchString . '%' );
			});
	}
	
	public function scopeSearchWithCompanyAuthor( $query, $searchString )
	{
		return $query->select( 'articles.*' )
			->leftjoin( 'authors', 'authors.id', '=', 'articles.author_id' )
			->leftjoin( 'companies', 'companies.id', '=', 'articles.company_id' )
			->where( function( $query ) use ( $searchString ) {
				$query->where( 'articles.title', 'LIKE', '%' . $searchString . '%' )
					->orWhere( 'articles.keywords', 'LIKE', '%' . $searchString . '%' )
					->orWhere( 'articles.tagline', 'LIKE', '%' . $searchString . '%' )
					->orWhere( 'authors.title', 'LIKE', '%' . $searchString . '%' )
					->orWhere( 'companies.title', 'LIKE', '%' . $searchString . '%' );
				});
	}

	public function scopeCategory( $query, $categoryID )
	{
		return $query->where( function( $query ) use ( $categoryID ) {
			$query->where( 'articles.category_id', $categoryID )
				->orWhere( 'articles.category_2_id', $categoryID )
				->orWhere( 'articles.category_3_id', $categoryID )
				->orWhere( 'articles.category_4_id', $categoryID )
				->orWhere( 'articles.category_5_id', $categoryID );
			});
	}
	
	public function scopeKeywords( $query, $searchString )
	{
		return $query->where( 'kewords', 'LIKE', '%' . $searchString . '%' );
	}
	
	public function scopePublished( $query )
	{
		 return $query->where( 'publish_status_id', 1 );
	}
	
	public function scopePublishedAndActive( $query )
	{
		 return $query->published()->where( 'articles.status_id', 0 );
	}
	
	public function scopeFeature( $query )
	{
		 return $query->publishedAndActive()->whereNotNull( 'image' );
	}

}

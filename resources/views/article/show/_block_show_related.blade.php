<?php 
  $relateds = App\Article::with( 'category' )
    ->publishedAndActive()
    ->category( $category_id )
    ->orderBy( 'id', 'desc' )
    ->take(5)
    ->get();
  if ( $relateds->count() < 6 ) {
		$relateds = $relateds->merge( 
      App\Article::with( 'category' )
        ->publishedAndActive()
        ->category( $category_2_id )
        ->orderBy( 'id', 'DESC' )
        ->take( 5 - $relateds->count() )
        ->get() 
		);
  }
  if ( $relateds->count() < 6 ) {
		$relateds = $relateds->merge( 
      App\Article::with( 'category' )
        ->publishedAndActive()
        ->category( $category_3_id )
        ->orderBy( 'id', 'DESC' )
        ->take( 5 - $relateds->count() )
        ->get() 
		);
  }
  if ( $relateds->count() < 6 ) {
		$relateds = $relateds->merge( 
      App\Article::with( 'category' )
        ->publishedAndActive()
        ->orderBy( 'id', 'DESC' )
        ->take( 5 - $relateds->count() )
        ->get() 
	  );
  }
?>

<div class='relateds'>
  <h2>Related Content</h2>
  @foreach ( $relateds AS $related )
    <div class='related'>
      <span class='related-title'><a href='/articles/content/{{ $related->slug }}'>{{ $related->title }}</a></span>
      <span class='related-category'><a href='/articles/content/{{ $related->slug }}'>{{ $related->category['title'] }}</a></span>
      <span class='related-read'><a  class='button small' target='_blank' href='/articles/content/{{ $related->slug }}'>Read</a></span>
    </div>
  @endforeach
</div>
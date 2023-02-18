<?php 
	$categoriesCollection = \App\Category::select( 'categories.*' )
		->join( 'categories AS parents', 'categories.parent_id', '=', 'parents.id' )
		->where( 'categories.slug', '!=', 'none' )
		->where( 'categories.status_id', 0 )
		->orderBy( 'parents.title' )
		->orderBy( 'categories.level' )
		->orderBy( 'categories.title' )
		->get();
	foreach ( $categoriesCollection AS $key => $value ) {
		if ( $value->level == 0 ) {
			$categories[$value->slug] = strtoupper( $value->title );
		} else {
			$categories[$value->slug] = '&nbsp;&nbsp;&nbsp;' . $value->title;
		}
	}
?>

<div class="filter-block">
  {!! Form::open( array( 'url' => route( 'articles.category' ), 'method' => 'get', 'id' => 'article_filter' )) !!}
    <div class='form-element inline-label'>
	    <label>Category:</label>
	    <div class="select-input-wrapper">
				{!! Form::select( 'category', $categories, isset( $slug ) ? $slug : '', array( 'id' => 'category' )) !!}
	    </div>
    </div>
    <div class='form-element inline-label'>
    	<label>Search:</label>
      {!! Form::text( 'search_string', isset( $search_string ) ? $search_string : null , [ 'id' => 'search_string' ]) !!}
    </div>
    <div class='form-actions'>
      {!! Form::submit( 'Go', array('class'=>'btn' )) !!}
    </div>
  {!! Form::close() !!}
</div>

<script>
  $(document).ready(function(){
    $( "#article_filter" ).submit( function(e) {
        e.preventDefault();
        window.location.href = "/articles/category/" + $( '#category' ).val() + "?search_string=" + $( '#search_string' ).val() ;
    });
		$( ".select-input-wrapper #category" ).change( function() {
        window.location.href = "/articles/category/" + $( '#category' ).val() + "?search_string=" + $( '#search_string' ).val() ;			
		});
  });
</script>

<?php 
  $releaseTypes = \App\ReleaseType::orderBy( 'id' )->lists( 'title', 'id' );
  $releaseTypes->prepend( 'All', 0 );
?>

<div class="filter-block">
  {!! Form::open( array( 'url' => route( 'releases.type' ), 'method' => 'get', 'id' => 'release_filter')) !!}
    <div class='form-element inline-label'>
	    <label>Release Type:</label>
			<div class="select-input-wrapper">
      	{!! Form::select( 'release_type_id', $releaseTypes, isset( $release_type_id ) ? $release_type_id : 0, array( 'id' => 'release_type' )) !!}
			</div>
    </div>
    <div class='form-element inline-label'>
	    <label>Search:</label>
    	{!! Form::text( 'search_string', isset( $search_string ) ? $search_string : null , [ 'id' => 'search_string' ]) !!}
    </div>
    <div class='form-actions'>
      {!! Form::submit( 'Go', array('class'=>'btn btn-large btn-primary btn-block' )) !!}
    </div>
  {!! Form::close() !!}
</div>

<script>
  $(document).ready(function(){
    $("#release_filter").submit(function(e){
        e.prreleaseDefault();
        window.location.href = "/releases/type/" + $( '#release_type' ).val() + "?search_string=" + $( '#search_string' ).val() ;
    });
		$( ".select-input-wrapper #release_type" ).change( function() {
        window.location.href = "/releases/type/" + $( '#release_type' ).val() + "?search_string=" + $( '#search_string' ).val() ;	
		});
  });
</script>
<?php 
  $videoTypes = \App\VideoType::orderBy( 'id' )->lists( 'title', 'id' );
  $videoTypes->prepend( 'All', 0 );
?>

<div class="video-filters filter-block">
  {!! Form::open( array( 'url' => route( 'videos.type' ), 'method' => 'get', 'id' => 'video_filter')) !!}
    <div class='form-element inline-label'>
	    <label>Video Type:</label>
			<div class="select-input-wrapper">
      	{!! Form::select( 'video_type_id', $videoTypes, isset( $video_type_id ) ? $video_type_id : 0, array( 'id' => 'video_type' )) !!}
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
    $("#video_filter").submit(function(e){
        e.preventDefault();
        window.location.href = "/videos/type/" + $( '#video_type' ).val() + "?search_string=" + $( '#search_string' ).val() ;
    });
		$( ".select-input-wrapper #video_type" ).change( function() {
        window.location.href = "/videos/type/" + $( '#video_type' ).val() + "?search_string=" + $( '#search_string' ).val() ;
		});
  });
</script>
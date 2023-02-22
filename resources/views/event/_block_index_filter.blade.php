<?php 
  $eventTypes = \App\EventType::orderBy( 'id' )->pluck( 'title', 'id' );
  $eventTypes->prepend( 'All', 0 );
?>

<div class="filter-block">
  {!! Form::open( array( 'url' => route( 'events.type' ), 'method' => 'get', 'id' => 'event_filter')) !!}
    <div class='form-element inline-label'>
	    <label>Event Type:</label>
	    <div class="select-input-wrapper">
				{!! Form::select( 'event_type_id', $eventTypes, isset( $event_type_id ) ? $event_type_id : 0, array( 'id' => 'event_type' )) !!}
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
    $("#event_filter").submit(function(e){
        e.preventDefault();
        window.location.href = "/events/type/" + $( '#event_type' ).val() + "?search_string=" + $( '#search_string' ).val() ;
    });
		$( ".select-input-wrapper #event_type" ).change( function() {
        window.location.href = "/events/type/" + $( '#event_type' ).val() + "?search_string=" + $( '#search_string' ).val() ;
		});
  });
</script>
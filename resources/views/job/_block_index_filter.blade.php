<?php 
  $jobTypes = \App\JobType::orderBy( 'id' )->pluck( 'title', 'id' );
  $jobTypes->prepend( 'All', 0 );
?>

<div class="filter-block">
  {!! Form::open( array( 'url' => route( 'jobs.by-type' ), 'method' => 'get', 'id' => 'job_filter')) !!}
    <div class='form-element inline-label'>
	    <label>Job Type:</label>
	    <div class="select-input-wrapper">
	    	{!! Form::select( 'job_type_id', $jobTypes, isset( $job_type_id ) ? $job_type_id : 0, array( 'id' => 'job_type' )) !!}
	    </div>
    </div>
    <div class='form-element inline-label'>
	    <label>Search:</span>
			{!! Form::text( 'search_string', isset( $search_string ) ? $search_string : null , [ 'id' => 'search_string' ]) !!}
    </div>
    <div class='form-actions'>
      {!! Form::submit( 'Go', array('class'=>'btn' )) !!}
    </div>
  {!! Form::close() !!}
</div>

<script>
  $(document).ready(function(){
    $("#job_filter").submit(function(e){
        e.prjobDefault();
        window.location.href = "/jobs/type/" + $( '#job_type' ).val() + "?search_string=" + $( '#search_string' ).val() ;
    });
		$( ".select-input-wrapper #job_type" ).change( function() {
        window.location.href = "/jobs/type/" + $( '#job_type' ).val() + "?search_string=" + $( '#search_string' ).val() ;		
		});
  });
</script>

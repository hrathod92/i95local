<?php 
  $companies = \App\Company::orderBy( 'title' )->pluck( 'title', 'id' );
  $companies->prepend( 'All', 0 );
	foreach ( $companies AS $company ) $company = \App\Helpers\Display::teaser( $company, 20 );

  $adTypes = \App\AdType::orderBy( 'id' )->pluck( 'title', 'id' );
  $adTypes->prepend( 'All', -1 );

  $statues = \App\Status::orderBy( 'id' )->pluck( 'title', 'id' );
  $statues->prepend( 'All', -1 );

?>

<div class="filter-block">

  {!! Form::open( array( 'url' => "ads", 'method' => 'get', 'id' => 'release_filter')) !!}

	<div class='form-element inline-label'>
		<label>Company:</label>
		<div class="select-input-wrapper">
			{!! Form::select( 'company_id', $companies, isset( $company_id ) ? $company_id : 0, array( 'id' => 'company' )) !!}
		</div>
	</div>

	<div class='form-element inline-label'>
		<label>Ad Type:</label>
		<div class="select-input-wrapper">
			{!! Form::select( 'ad_type_id', $adTypes, isset( $ad_type_id ) ? $ad_type_id : -1, array( 'id' => 'ad_type' )) !!}
		</div>
	</div>
	
	<div class='form-element inline-label'>
		<label>Status:</label>
		<div class="select-input-wrapper">
			{!! Form::select( 'status_id', $statues, isset( $status_id ) ? $status_id : -1, array( 'id' => 'status' )) !!}
		</div>
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
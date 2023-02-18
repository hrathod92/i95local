<?php 
  $companies = \App\Company::orderBy( 'title' )->lists( 'title', 'id' );
  $companies->prepend( 'All', 0 );
	foreach ( $companies AS $company ) $company = \App\Helpers\Display::teaser( $company, 20 );

  $adTypes = \App\AdType::orderBy( 'title' )->lists( 'title', 'id' );
  $adTypes->prepend( 'All', -1 );

  $statues = \App\Status::orderBy( 'id' )->lists( 'title', 'id' );

	$categories = \App\Category::where('id', '!=', 0)->where('status_id', 0)->orderBy( 'id' )->lists( 'title', 'id' );
  $categories->prepend( 'All', -1 );
?>

<div class="filter-block">
  {!! Form::open( array( 'url' => "ads", 'method' => 'get', 'id' => 'release_filter')) !!}
    <div class='form-element'>
      <label>Type</label>
      <div class="select-input-wrapper">
        {!! Form::select( 'ad_type_id', $adTypes, isset( $ad_type_id ) ? $ad_type_id : -1, array( 'id' => 'ad_type' )) !!}
      </div>
    </div>
    <div class='form-element'>
      <label>Company</label>
      <div class="select-input-wrapper">
        {!! Form::select( 'company_id', $companies, isset( $company_id ) ? $company_id : 0, array( 'id' => 'company' )) !!}
      </div>
    </div>	
		<div class='form-element'>
			<label>Category:</label>
			<div class="select-input-wrapper">
				{!! Form::select( 'category_id', $categories, isset( $category_id ) ? $category_id : -1, array( 'id' => 'category' )) !!}
			</div>
		</div>
    <div class='form-element'>
      <label>Status</label>
      <div class="select-input-wrapper">
        {!! Form::select( 'status_id', $statues, isset( $status_id ) ? $status_id : 0, array( 'id' => 'status' )) !!}
      </div>
    </div>
    <div class='form-actions'>
      {!! Form::submit( 'Filter', array('class'=>'btn btn-large btn-primary btn-block' )) !!}
    </div>
  {!! Form::close() !!}
</div>

<style>
  .filter-block {
    text-align:left;
    padding: 1em 0.5em;
  }
  .filter-block label {
    margin-bottom: 0.1em;
		font-weight: bold;
  }
  .filter-block .select-input-wrapper {
    margin-bottom: 0.5em;
  }
  .filter-block .select-input-wrapper select {
    width: 100%;
  }
  .filter-block .form-element, .filter-block .form-actions {
    display: block;
  }
</style>

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

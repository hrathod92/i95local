@if (\Auth::user()->role === 'admin')
	<?php 
	  $companies = \App\Company::where( 'status_id', 0 )
  			->orderBy( 'title' )
  			->pluck( 'title', 'id' );
	  	$companies->prepend( 'All', 0 );
		foreach ( $companies AS $complist ) $complist = \App\Helpers\Display::teaser( $complist, 20 );
	?>
	<?php $blockTypes = \App\Click::select( 'clickable_type' )
	  	->whereNotNull( 'clickable_type' )
		->distinct( 'clickable_type' )
	  	->orderBy( 'clickable_type' )
	  	->pluck( 'clickable_type' );
		$blockTypes->prepend( 'All');
	?>
	<div class="filter-block">
	  {!! Form::open( array( 'url' => "clicks/filter", 'method' => 'get', 'id' => 'release_filter')) !!}
		<div class='form-element'>
		  <label>Company</label>
		  <div class="select-input-wrapper">
			<select name="company" id="company">
			@foreach($companies as $key => $value)
				<option {{ $company_id == $key ? 'selected="selected"' : null }} value="{{ $key }}">{{ $value }}</option>
			@endforeach
			</select>
		  </div>
		</div>
		<div class='form-element'>
		  <label>Type</label>
		  <div class="select-input-wrapper">
			<select name="type" id="type">
			@foreach($blockTypes as $typelist)
				<option {{ $type == $typelist ? 'selected="selected"' : null }} value="{{ $typelist }}">{{ $typelist }}</option>
			@endforeach
			</select>
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
@endif
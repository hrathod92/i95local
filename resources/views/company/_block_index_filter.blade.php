<div class="filter-block">
  {!! Form::open( array( 'url' => 'companies', 'method' => 'get', 'id' => 'company_filter')) !!}
    <div class='form-element inline-label'>
	    <label>Search:</label>
      {!! Form::text( 'search_string', isset( $search_string ) ? $search_string : null , [ 'id' => 'search_string' ]) !!}
    </div>
    <div class='form-actions'>
      {!! Form::submit( 'Go', array('class'=>'btn btn-large btn-primary btn-block' )) !!}
    </div>
  {!! Form::close() !!}
</div>
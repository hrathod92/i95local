<div class='search-form'>
  {!! Form::open( array( 'url' => 'search', 'method' => 'GET' )) !!}
    <div class="form-element">
      {!! Form::label( 'terms', 'Search Terms' ) !!} 
      {!! Form::text( 'terms', $terms ) !!}
    </div>
    <div class="form-actions">
      {!! Form::submit( 'Submit', array('class'=>'btn btn-large btn-primary btn-block' )) !!}
    </div>
  {!! Form::close() !!}
</div>
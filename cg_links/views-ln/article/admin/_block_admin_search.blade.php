<div class="article-filters filter-block">
  {!! Form::open( array( 'url' => 'articles/admin', 'method' => 'get', 'id' => 'article_filter' )) !!}
    <div class='form-element inline-label'>
    	<label>Search:</label>
      {!! Form::text( 'search_string', isset( $search_string ) ? $search_string : null , [ 'id' => 'search_string' ]) !!}
    </div>
    <div class='form-actions'>
      {!! Form::submit( 'Go', array('class'=>'btn' )) !!}
    </div>
  {!! Form::close() !!}
</div>

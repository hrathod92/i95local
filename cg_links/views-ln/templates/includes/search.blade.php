<div class="search-block">
  {!! Form::open(['url' => '/product/search']) !!}

    {!! Form::select( 'category_id', \App\Category::orderBy( 'parent_id' )->orderBy( 'level' )
      ->lists( 'title', 'id' ), null, [ 'class' => 'search-category' ] ) !!}

    {!! Form::text( 'search_text', null, array( 'class' => 'search-text' )) !!}
  
    {!! Form::submit( 'Search', array('class'=>'search-button btn btn-large btn-primary btn-block' )) !!}
  {!! Form::close() !!}
</div>
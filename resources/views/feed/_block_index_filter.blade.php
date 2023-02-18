<div class="feed-filters">
  {!! Form::open( array( 'url' => 'feeds', 'method' => 'get', 'id' => 'feed_filter')) !!}
    <span class='form-element'>
      Search:
    </span>
    <span class='form-element'>
      {!! Form::text( 'search_string', isset( $search_string ) ? $search_string : null , [ 'id' => 'search_string' ]) !!}
    </span>
    <span class='form-element'>
      {!! Form::submit( 'Search', array('class'=>'btn btn-large btn-primary btn-block' )) !!}
    </span>
  {!! Form::close() !!}
</div>

<style>
  .feed-filters {
    background: #ccc;
    padding: 1em;
  }
  .feed-filters form {
    margin: 0;
  }
  .feed-filters .form-element {
    display: inline-block;
    float: none;
    margin: 0 2em;
  }
</style>

<?php 
  $newsletterYear = \App\NewsletterYear::where( 'title', '<=', date( 'Y' ))->orderBy( 'title', 'DESC' )->lists( 'title', 'title' );
  $newsletterYear->prepend( 'All', 'all' );
?>

<div class="filter-block">
  {!! Form::open( array( 'url' => route( 'newsletter.year' ), 'method' => 'get', 'id' => 'newsletter_filter')) !!}
    <div class='form-element inline-label'>
	    <label>Year:</label>
			<div class="select-input-wrapper">
      	{!! Form::select( 'title', $newsletterYear, isset( $newsletter_year ) ? $newsletter_year : 0, array( 'id' => 'newsletter_year' )) !!}
			</div>
    </div>
    <div class='form-actions'>
      {!! Form::submit( 'Go', array('class'=>'btn' )) !!}
    </div>
  {!! Form::close() !!}
</div>

<script>
  $(document).ready(function(){
    $("#newsletter_filter").submit(function(e){
        e.preventDefault();
        window.location.href = "/newsletters/archive/year/" + $( '#newsletter_year' ).val();
    });
  });
</script>

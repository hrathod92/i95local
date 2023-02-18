<?php 
	$page['title'] = $title;
  $page['sideblocks'] = array( 'ad._block_ads_side' );
	$page['css'] = 'messages'; 
?>

@extends( 'templates.default' )
@section( 'content' )

<h2>Message Info</h2>

<div class='message-info'>
	<h3>{{ $body }}</h3>		
</div>

@if ( Auth::check() && Auth::user()->role == 'admin' )
    <p><a href='/messages/{{ $id }}/edit'>edit</a></p>
@endif

@stop
<?php $page['css'] = 'home'; ?>

@extends( 'templates.default' )

@section('hero')
	@include( 'home._block_home_featured_articles' )
@stop

@section ( 'content' )

	@if ( \Session::has( 'message' ))
		<p id='login-message'>{!! \Session::get( 'message' ) !!}</p>
	@endif

	@include( 'home._block_home_leaderboard_top' )

	@include( 'home._block_home_top_articles' )
	@include( 'home._block_home_more_articles' )
	@include( 'home._block_home_videos' )

	@include( 'home._block_home_leaderboard_bottom' )

	@include( 'home._block_home_releases' )

@stop

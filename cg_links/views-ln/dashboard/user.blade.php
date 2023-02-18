<?php
  $page['title'] = 'Company Dashboard';
  if($company) $page['title'] .= ' : ' . $company->title;
  if ( !empty( $user )) $page['title'] .= ' (' . $user->full_name . ')';
  $page['sideblocks'] = [ 'dashboard._block_user' ];
  $page['css'] = 'dashboard';
?>

@extends( 'templates.default' )

@section( 'content' )

@if( Session::has( 'message' ))
  <div class="message">{{ Session::get( 'message' ) }}</div>
@endif

@include( 'dashboard.user._block_user_recent_messages' )
@include( 'dashboard.user._block_user_recent_articles' )
@include( 'dashboard.user._block_user_recent_videos' )
@include( 'dashboard.user._block_user_recent_releases' )
@include( 'dashboard.user._block_user_recent_events' )

@stop

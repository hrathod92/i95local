<?php
  $page['title'] = 'Agency Dashboard';
  if($company) $page['title'] .= ' : ' . $company->title;
  if ( !empty( $user )) $page['title'] .= ' (' . $user->full_name . ')';
  $page['sideblocks'] = [ 'dashboard.agency._agency','dashboard._block_agency' ];
  $page['css'] = 'dashboard';
  $clients = \App\Helpers\Agency::getClientList(Auth::user()->company_id);
  $mine = \App\Company::find(Auth::user()->company_id->first());
?>
@extends( 'templates.default' )

@section( 'content' )

@if( Session::has( 'message' ))
  <div class="message">{{ Session::get( 'message' ) }}</div>
@endif

@include( 'dashboard.agency._block_agency_recent_messages' )
@include( 'dashboard.agency._clients' )


@stop

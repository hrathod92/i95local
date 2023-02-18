<?php 
  $page['sideblocks'] = array( 'agency.show._agency','dashboard._block_admin' ); 
  $page['css'] = 'dashboard'; 
?>
@extends( 'templates.default' )
<title>{{ $title }} | I95 Business</title>
@section( 'content' )


@include( 'agency.show._show_client' )
@include( 'agency.show._add_client' )

@if ( Auth::check() && Auth::user()->role == 'admin' )
    <p><a href='/agency/{{ $id }}/edit'>edit</a></p>
@endif

<style>
  #main #main-inner {
    padding-top: 1em;
  }
  #content #content-area .logo-title {
    margin-top: 0;
    margin-bottom: 0.5em;
  }
  #content #content-area .logo-title img {
    display: inline-block;
    width: 20%;
    vertical-align: middle;
  }
  #content #content-area .logo-title h1 {
    display: inline-block;
    vertical-align: middle;
    margin-left: 0.5em;
    border-left: 1px solid #999;
    padding-left: 0.75em;
  }
  .article-feature-wrapper .feature .image-wrapper .image-crop img {
    max-height: 100%;
    height: auto;
  }
</style>

@stop

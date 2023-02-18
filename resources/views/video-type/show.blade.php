<?php 
  $page['title'] = 'Video Type'; 
  $page['sideblocks'] = array( 'ad._block_ads_side' );
  $page['css'] = 'video-type-show'; 
?>
@extends( 'templates.default' )
@section( 'content' )

@include( 'ad._block_ads_header' )

<div class="video">
  <div class='video-title'><span>Video Type:</span><span>{!! $title !!}</span></div>
</div>

@if ( Auth::check() && Auth::user()->role == 'admin' )
  <p><a class='button' href='/video-types/{{ $id }}/edit'>edit</a></p>
@endif

<style>
  .video {
    width: 90%;
    margin: 0 auto;
  }
  .video > div {
    margin: 1em 0;
  }
  .video > div > span {
    display: inline-block;
    vertical-align: top;
    margin: 0 0 1em;
  }
  .video > div > span:first-child {
    font-weight: bold;
    width: 150px;
  }
  .video > div > span:last-child {
    width: 500px;
  }
  .video > div > span > p {
    margin: 0 0 0.5em;
  }
</style>

@include( 'ad._block_ads_info' )

@stop
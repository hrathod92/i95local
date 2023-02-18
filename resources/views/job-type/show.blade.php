<?php 
  $page['title'] = 'Job Type'; 
  $page['sideblocks'] = array( 'ad._block_ads_side' );
  $page['css'] = 'job-type-show'; 
?>
@extends( 'templates.default' )
@section( 'content' )

@include( 'ad._block_ads_header' )

  <div class="job">
      <div class='job-title'><span>Job Type:</span><span>{!! $item->title !!}</span></div>
  </div>

<style>
  .job {
    width: 90%;
    margin: 0 auto;
  }
  .job > div {
    margin: 1em 0;
  }
  .job > div > span {
    display: inline-block;
    vertical-align: top;
    margin: 0 0 1em;
  }
  .job > div > span:first-child {
    font-weight: bold;
    width: 150px;
  }
  .job > div > span:last-child {
    width: 500px;
  }
  .job > div > span > p {
    margin: 0 0 0.5em;
  }
</style>

@include( 'ad._block_ads_info' )

@if ( Auth::check() && Auth::user()->role == 'admin' )
    <p><a href='/job-types/{{ $item->id }}/edit'>edit</a></p>
@endif

@stop
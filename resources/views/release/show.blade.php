<?php 
  $page['title'] = 'Press Release';
  $page['sideblocks'] = array( 'release.ad._block_ads_side' );
  $page['css'] = 'release-show'; 
?>

@extends( 'templates.default' )
@section('head')
	<meta property="og:url"           content="{{ Request::fullUrl() }}" />
  	<meta property="og:type"          content="website" />
  	<meta property="og:title"         content="{{ $title}} | Press Release | I95 Business" />
  	<meta property="og:description"   content="{{ isset( $keywords ) ? $keywords.' | ' : null }}I95 Business" />
  	<meta property="og:image"         content="{{ !empty($image) ? url('/').'/data/releases/img/'.$image : null }}" />
<title>{{ $title}} | Press Release | I95 Business</title>
@endsection
@section( 'content' )

@include( 'release.ad._block_ads_header' )

<div class="release">
  @if ( !empty( $image ))
   <div class="release-image"><img src="/data/releases/img/{{ $image }}?ut={{ str_replace( ' ', '-', $updated_at ) }}"></div>
  @endif
  <div class='release-text{{ !empty( $image ) ? " with-image" : "" }}'>
    <h2 class='release-title'>{{ $title }}</h2>
    <p class='release-body'>{!! $body !!}</p>    
  </div>
</div>

@include( 'release.ad._block_ads_info' )

@if ( Auth::check() && in_array( Auth::user()->role, ['user', 'admin'] ))
  <br />
  <div>Keywords: {{ isset( $keywords ) ? $keywords : '' }}</div>
  <p><a class='button' href='/releases/{{ $id }}/edit'>edit</a></p>
  <br />
@endif

<style>
  .release-image {
    float: left;
    width: 15%;
    margin: 0 1% 1% 0;
    padding: 0.5em 0 0;
  }
  .release-image img {
    width: 100%;
  }
  .release-text.with-image {
    margin-left: 18%;
  }
  .leaderboard-banner.bottom {
    clear: both;
  }
</style>

@stop
<?php 
    $page['title'] = 'Feeds';
    $page['sideblocks'] = array( 'ad._block_ads_side' );
    $page['css'] = 'dashboard';
?>

@extends( 'templates.default' )
@section('head')
	<meta property="og:url"           content="{{ Request::fullUrl() }}" />
  	<meta property="og:type"          content="website" />
  	<meta property="og:title"         content="RSS Feeds | I95 Business" />
  	<meta property="og:description"   content="RSS Feeds | I95 Business" />
<title>RSS Feeds | I95 Business</title>
@endsection
@section( 'content' )

@include( 'ad._block_ads_header' )

@include( 'feed._block_index_filter' )

<div class='feeds'>
    @foreach ( $items as $item )
      <div class='feed'>
        <div class="feed-button"><a class='button small' href='/feeds/{{ $item->id }}'>View Feeds</a></div>
        <div class="feed-title"><a href='/feeds/{{ $item->id }}'>{{ $item->title }}</a></div>
      </div>
    @endforeach
</div>

<style>
  .feeds .feed {
    border-bottom: 1px solid #ccc;
  }
  .feeds .feed > div {
    display: inline-block;
    padding: 1em;
  }
  .feeds .feed > .feed-button {
    clear: both;
    float: right;
    padding: 0.625em 1em;
  }
</style>

@include( 'ad._block_ads_info' )

@stop

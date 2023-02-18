<?php
  $page['title'] = 'Search';
  $page['sideblocks'] = [ 'article.index._block_index', 'ad._block_ads_side' ];
  $page['css'] = 'search'; 
?>

@extends( 'templates.default' )
@section('head')
	<meta property="og:url"           content="{{ Request::fullUrl() }}" />
  	<meta property="og:type"          content="website" />
  	<meta property="og:title"         content="Search | I95 Business" />
  	<meta property="og:description"   content="Search | I95 Business" />
<title>Search | I95 Business</title>
@endsection
@section( 'content' )

@include( 'search._block_index_search' )
@include( 'search._block_index_articles' )
@include( 'search._block_index_videos' )
@include( 'search._block_index_releases' )
@include( 'search._block_index_companies' )

@include( 'ad._block_ads_info' )

@stop

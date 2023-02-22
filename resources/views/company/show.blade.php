<?php
    $page['sideblocks'] = [ 'company.show._block_sidebar' ];
    $page['css'] = 'company-show';
	  $video_count = \App\Video::where( 'company_id', $id )
		->where( 'status_id', 0 )
		->orderBy( 'id', 'DESC' )
		->count(); 
    $article_count = App\Article::with( 'category', 'click' )
		->publishedAndActive()
		->where( 'company_id', $id )
		->count();
?>

@extends( 'templates.default' )
@section('head')
	<meta property="og:url"           content="{{ Request::fullUrl() }}" />
  	<meta property="og:type"          content="website" />
  	<meta property="og:title"         content="{{ $title }} BrandStories | I95 Business" />
  	<meta property="og:description"   content="{{ $title }} BrandStories | I95 Business" />
  	<meta property="og:image"         content="{{ !empty($image) ? url('/').'/data/companies/img/'.$image : null }}" />
<title>{{ $title }} BrandStories | I95 Business</title>
@endsection
@section( 'content' )

<div class='logo-title'>
  <img class='company-logo' src="/data/companies/img/{{ $image }}?ut={{ str_replace( ' ', '-', $updated_at ) }}" alt="Logo for {{ $title }}" />
  <h1>{{ $title }} BrandStories</h1>  
</div>

@if($article_count > 4)
	@include( 'company.show._block_show_featured' )
@endif

@include( 'company.show._block_show_ad_header' )

@if($article_count > 0)
  @include( 'company.show._block_show_articles' )
@endif

@if($video_count > 0)
  @include( 'company.show._block_show_videos' )
@endif

@if ( Auth::check() && Auth::user()->role == 'admin' )
    <p><a href='/companies/{{ $id }}/edit'>edit</a></p>
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

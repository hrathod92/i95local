<?php $page['title'] = $title; ?>
<?php $page['sideblocks'] = [ 'video.ad._block_ads_side' ]; ?>
<?php $page['css'] = 'video-show'; ?>

@extends( 'templates.default' )
@section('head')
	<meta property="og:url"           content="{{ Request::fullUrl() }}" />
  	<meta property="og:type"          content="website" />
  	<meta property="og:title"         content="{{ $page['title']}} | Video | I95 Business" />
  	<meta property="og:description"   content="{{ $page['title']}} | Video | I95 Business" />
<title>{{ $page['title']}} | Video | I95 Business</title>
@endsection
@section( 'content' )

@include( 'video.ad._block_ads_header' )

<div class="video">
		<div class='video-video'>
			<?php Header('X-XSS-Protection: 0'); //<- Necessary for Chrome. ?>
			<div class="media-embed">{!! $embed !!}</div>
		</div>
    <div class='video-body'>{!! nl2br($body) !!}</div>
</div>

@include( 'video.ad._block_ads_info' )

@if ( Auth::check() && Auth::user()->role == 'admin' )
  <div class='video-keywords'>Keywords: {{ $keywords }}</div>
	<br />
  <p><a class='button' href='/videos/{{ $id }}/edit'>edit</a></p>
@endif

@stop
<?php 
  $page['title'] = 'Releases';
  $page['sideblocks'] = [ 'release._block_index_sidebar', 'release.ad._block_ads_side' ];
  $page['css'] = 'release-index'; 
?>

@extends( 'templates.default' )
@section('head')
	<meta property="og:url"           content="{{ Request::fullUrl() }}" />
  	<meta property="og:type"          content="website" />
  	<meta property="og:title"         content="{{ !empty($type) ? $type.' | ' : null }}Releases | I95 Business" />
  	<meta property="og:description"   content="Releases | I95 Business" />
<title>{{ !empty($type) ? $type.' | ' : null }}Releases | I95 BusinessReleases | I95 Business</title>
@endsection
@section( 'content' )

@include( 'release.ad._block_ads_header' )

@include( 'release._block_index_filter' )

<div class='releases'>
  @if ( $items->count() )
    @foreach ( $items AS $release )
      <div class="release">
        <div class="release-title"><a href="/releases/{{ $release->id }}">{{ $release->title }}</a></div>
        <div class="release-type">{{ $release->release_type['title'] }}</div>
        <div class="release-date">{{ date( 'M d, Y', strtotime( $release->created_at )) }}</div>
      </div>
    @endforeach
  @else
		<div class="release-empty" data-label="Empty">No articles found.  Please select another category or search term.</div>
	@endif
</div>

@include( 'release.ad._block_ads_info' )

<style>
	.release-empty {
		border: 1px solid #666;
    padding: 1em 2em;
    text-align: center;
    background: #ddd;
    width: 100%;
	}
</style>

@stop
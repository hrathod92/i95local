<?php
  use \App\Helpers\Display;
  $page['title'] = $title;
  $page['sideblocks'] = array( 'event.ad._block_ads_side' );
  $page['css'] = 'events'; 
?>

@extends( 'templates.default' )
@section('head')
	<meta property="og:url"           content="{{ Request::fullUrl() }}" />
  	<meta property="og:type"          content="website" />
  	<meta property="og:title"         content="{{ $page['title']}} | Events | I95 Business" />
  	<meta property="og:description"   content="{{ $page['title']}} | Events | I95 Business" />
  	<meta property="og:image"         content="{{ !empty($image) ? url('/').'/data/events/img/'.$image : null }}" />
<title>{{ $page['title']}} | Events | I95 Business</title>
@endsection
@section( 'content' )

@include( 'event.ad._block_ads_header' )

<div class="content-view-wrapper event-detail-page">
  
  @if ( !empty( $image ))
    <div class='event-detail-image'>
      <img src="/data/events/img/{{ $image }}?ut={{ str_replace( ' ', '-', $updated_at ) }}" alt="{{ !empty($image_alt) ? $image_alt : $title }}" />
    </div>
  @endif
  
  <style>
    @if ( $image_size < 100 )
      .event-detail-page .event-detail-image img {
        float: left;
        width: {{ $image_size }}%;
      }
      .event-detail-page .event-detail-text {
        margin-left: {{ $image_size + 1 }}%;
      }
    @else
      .event-detail-page .event-detail-image img {
        width: {{ $image_size . '%' }};
      }
      .event-detail-page .event-detail-text {
        margin-top: 2em;
      }
    @endif
  </style>
  
  <div class='event-detail-text'>
    <div class="detail dates">
      {!! Display::dateStd( $starts_at ) !!}
      @if ( !empty( $ends_at ) && $ends_at != $starts_at )
        - {!! Display::dateStd( $ends_at ) !!}
      @endif
    </div>
    <div class="detail location">{!! $location or '' !!}</div>
    <div class="detail description">{!! $description !!}</div>
    @if ( !empty( $contact ))
      <div class="detail contact">
        <strong>Contact Info: </strong>
        {!! $contact !!}
      </div>
    @endif
    <div class="detail website">
      <strong>Info: </strong>
      @if (( strpos( $url, 'http' ) !== false ) || ( strpos( $url, 'https' ) !== false ))
        <a href='{!! $url !!}' target="_blank">{!! $url!!}</a>
      @else
        <a href='http://{!! $url !!}' target="_blank">{!! $url !!}</a>
      @endif
    </div>
  </div>
</div>

@if ( Auth::check() && Auth::user()->role == 'admin' )
  <br />
  <div class="actions bottom"><a class="button small" href='/events/{{ $id }}/edit'>Edit</a></div>
  <br />
@endif

@include( 'event.ad._block_ads_info' )


@stop

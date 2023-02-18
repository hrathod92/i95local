<?php 
  $page['title'] = $title;
  if ( $ad_show_id == 0 ) $page['sideblocks'] = [ 'ad._block_ads_side' ];
  $page['css'] = 'dashboard'; 
?>

@extends( 'templates.default' )
@section( 'content' )

@if ( $ad_show_id == 0 )
  @include( 'ad._block_ads_header' )
@endif

@include( 'content._block_content' )

<div class='content-body'>
  
  @if ( isset( $image ) && strlen( $image ) > 0 )
    <div class="content-image"><img src="/data/contents/img/{{ $image }}?ut={{ str_replace( ' ', '-', $updated_at ) }}" alt="Image: {{ $title }}"></div>
  @endif

  {!! $body !!}
  
</div>

@if ( Auth::check() && Auth::user()->role == 'admin' )
  <div class="actions bottom"><a class="button small" href='/contents/{{ $id }}/edit'>Edit</a></div>
  <br />
@endif

@if ( $ad_show_id == 0 )
  @include( 'ad._block_ads_info' )
@endif

<style>
  .content-image img {
      width: 70%;
      margin-bottom: 2em;
  }
</style>

@if ( !empty( $css ))
  <style>{!! $css !!}</style>
@endif
  
@stop

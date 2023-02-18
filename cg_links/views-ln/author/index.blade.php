<?php 
  $page['title'] = 'Authors';
  $page['sideblocks'] = array( 'ad._block_ads_side' );
  $page['css'] = 'authors'; 
?>

@extends( 'templates.default' )
@section( 'content' )

@include( 'ad._block_ads_header' )

<div class='authors'>
    @foreach ( $authors AS $author )
        <div class="author">
            <div class="author-title"><a href="/authors/{{ $author->id }}">{{ $author->title }}</a></div>
            <div class="author-description">{{ $author->body }}</div>
        </div>
    @endforeach
</div>

@include( 'ad._block_ads_info' )

@stop

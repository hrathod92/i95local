<?php 
  $page['title'] = 'Messages';
  $page['sideblocks'] = array( 'dashboard._block_user' );
  $page['css'] = 'messages'; 
?>

@extends( 'templates.default' )
@section( 'content' )

@include( 'ad._block_ads_header' )

<div class='messages'>
    @foreach ( $messages AS $message )
        <div class="message">
            <div class="message-title"><a href="/messages/{{ $message->id }}">{{ $message->title }}</a></div>
            <div class="message-description">{{ $message->body }}</div>
        </div>
    @endforeach
</div>

@include( 'ad._block_ads_info' )

@stop

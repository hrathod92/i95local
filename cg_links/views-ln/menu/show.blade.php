<?php 
  $page['title'] = 'Menu : ' . $title;
  $page['sideblocks'] = [ 'dashboard._block_admin' ];
  $page['css'] = 'dashboard'; 
?> 

@extends( 'templates.default' ) @section( 'content' )

<div class="menu">
  @if ( isset( $image ) && strlen( $image ) > 0 )
  <div class="menu-image"><img src="/data/menus/img/{{ $image }}"></div>
  @endif
  <p class='menu-body'>{!! $body !!}</p>
</div>

@if ( Auth::check() && Auth::user()->role == 'admin' )
  <p><a class="button small" href='/menus/{{ $id }}/edit'>edit</a></p>
@endif @stop

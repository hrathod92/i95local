<?php 
  $page['title'] = 'FAQ - ' . $refno . ' ' . $title . ' (' . $type . ')';
  $page['sideblocks'] = [ 'faq._block_sidebar' ];
  $page['css'] = 'faq-show'; 
?>

@extends( 'templates.default' )
@section( 'content' )

<div class="faq">
   <p class='faq-body'>{!! $body !!}</p>
</div>

@if ( Auth::check() && Auth::user()->role == 'admin' )
    <p><a class='button' href='/faqs/{{ $id }}/edit'>edit</a></p>
@endif

@stop
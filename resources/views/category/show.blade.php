<?php
    $page['title'] = 'Category';
    $page['sideblocks'] = ['dashboard._block_admin'];
    $page['css'] = 'dashboard';
?>

@extends( 'templates.default' )
@section( 'content' )

<div class="item-page">
    <div class='item-wrapper'>
      <h2 class='title'>Title: {!! $item->title !!}</h2>
      <p class='slug'>Slug: {!! $item->slug !!}</p>
      <p class='slug'>Level: {!! $item->level !!}</p>
      <p class='slug'>Parent: {!! $item->parent->title !!}</p>
      @if ( Auth::check() && Auth::user()->role == 'admin' )
          <div class="actions bottom"><a class="button small" href='/categories/{{ $item->id }}/edit'>Edit</a></div>
      @endif
    </div>
</div>

@stop
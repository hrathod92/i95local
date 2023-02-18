<?php $page['title'] = 'Hero Slider - ' . $title; ?>
<?php $page['sideblocks'] = [ 'dashboard._block_admin' ]; ?>
<?php $page['css'] = 'dashboard'; ?>

@extends( 'templates.default' )
@section( 'content' )

<div class="content-view-wrapper">
    <div><strong>Title:</strong> {!! $title !!}</div>
    <div><strong>Caption:</strong> {!! $caption !!}</div>
    <div><strong>Url:</strong> {!! $url !!}</div>
    <div><strong>Button Text:</strong> {!! $button_text !!}</div>
    <div><strong>Image:</strong> <img src='/data/hero_sliders/{!! $image !!}' /></div>
</div>

@if ( Auth::check() && Auth::user()->role == 'admin' )
    <div class="actions bottom"><a class="button small" href='/sliders/{{ $id }}/edit'>Edit</a></div>
@endif

@stop
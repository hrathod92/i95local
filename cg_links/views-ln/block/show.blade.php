<?php $page['title'] = 'Block - ' . $title; ?>
<?php $page['sideblocks'] = [ 'dashboard._block_admin' ]; ?>
<?php $page['css'] = 'dashboard'; ?>

@extends( 'templates.default' )
@section( 'content' )

<div class="content-view-wrapper">
    <div><strong>Title:</strong> {!! $title !!}</div>
    <div><strong>Type:</strong> {!! $type !!}</div>
    <div><strong>Slug:</strong> {!! $slug !!}</div>
    <div><strong>Class:</strong> {!! $class !!}</div>
    <div><strong>Content:</strong> {!! $body !!}</div>
</div>

@if ( Auth::check() && Auth::user()->role == 'admin' )
    <div class="actions bottom"><a class="button small" href='/blocks/{{ $id }}/edit'>Edit</a></div>
@endif

@stop
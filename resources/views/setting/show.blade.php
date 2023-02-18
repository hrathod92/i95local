<?php $page['title'] = 'Setting - ' . $title; ?>
<?php $page['sideblocks'] = array( 'dashboard._block_admin'); ?>
<?php $page['css'] = 'dashboard'; ?>

@extends( 'templates.default' )
@section( 'content' )

<div class="content-view-wrapper">
  <div><strong>Title:</strong> {!! $title !!}</div>
  <div><strong>Type:</strong> {!! $type !!}</div>
  <div><strong>Slug:</strong> {!! $slug !!}</div>
  <div><strong>Content (Body):</strong> {!! $body !!}</div>
</div>
@if ( Auth::check() && Auth::user()->role == 'admin' )
    <div class="actions bottom"><a class="button small" href='/settings/{{ $id }}/edit'>Edit</a></div>
@endif

@stop
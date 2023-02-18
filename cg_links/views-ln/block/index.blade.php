<?php 
    $page['title'] = 'Admin - Blocks';
    $page['sideblocks'] = array( 'dashboard._block_admin' );
    $page['css'] = 'dashboard';
?>

@extends( 'templates.default' )
@section( 'content' )

<p><a class='button small icon-left' href='/blocks/create'><i class="fa fa-plus"></i>Create Block</a></p>

<table class='blocks'>
  <thead>
    <tr>
      <th>Title</th>
      <th class="align-center">Type</th>
      <th class="align-center">Slug</th>
      <th class="align-center">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach ( $blocks AS $block )
      <tr>
        <td class="block-title" data-label="Title"><a href="/blocks/{{ $block->id }}">{{ $block->title }}</a></td>
        <td class="nowrap align-center" data-label="Type"><a href="/blocks/{{ $block->id }}">{{ $block->type }}</a></td>
        <td class="nowrap align-center" data-label="Slug"><a href="/blocks/{{ $block->id }}">{{ $block->slug }}</a></td>
        <td class="nowrap align-center" data-label="Actions"><a class='button small' href='/blocks/{{ $block->id }}/edit'>edit</a></td>
      </tr>
    @endforeach
  </tbody>
</table>

@stop
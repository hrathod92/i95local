<?php
  $page['title'] = 'Categories';
  $page['sideblocks'] = ['dashboard._block_admin'];
  $page['css'] = 'dashboard';
?>

@extends( 'templates.default' )
@section( 'content' )

<p>
  <a class='button small icon-left' href="/categories/create"><i class="fa fa-plus"></i>Create New Category</a>
</p>

<table>
  <thead>
    <tr>
      <th>Title</th>
      <th class="align-center">Slug (ID)</th>
      <th class="align-center">Level (Parent)</th>
      <th class="align-center">Status</th>
      <th class="align-center"></th>
    </tr>
  </thead>
  <tbody>
    @foreach ( $items AS $item )
      <tr>
        <td class="title" data-label="title">
          {{ str_repeat( '&nbsp;', 4*$item->level ) }}
          <a {!! $item->level == 0 ? "style='font-weight:bold'" : '' !!} href="/categories/{{ $item->id }}">{{ $item->title }}</a>
        </td>
        <td class="slug" data-label="id">{{ $item->slug }} ({{ $item->id }})</td>
        <td class="level align-center" data-label="level">{{ $item->category_level->title }} ({{ $item->parent_id }})</td>
        <td class="status align-center" data-label="status">{{ $item->status->title }}</td>
        <td class='edit align-center nowrap'><a class='button small' href='/categories/{{ $item->id }}/edit'>Edit</a></td>
      </tr>
      @endforeach
  </tbody>
</table>
    
@stop
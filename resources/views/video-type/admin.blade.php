<?php
  $page['title'] = 'Admin - Video Types';
  $page['sideblocks'] = array( 'dashboard._block_admin' );
  $page['css'] = 'dashboard';
?>

@extends( 'templates.default' )
@section( 'content' )

<p>
  <a class="button small icon-left" href='/video-types/create'><i class="fa fa-plus"></i>Create Video Type</a>
</p>

<table class='blocks'>
  <thead>
    <tr>
      <th>Title</th>
      <th class="align-center" colspan="2">Action(s)</th>
    </tr>
  </thead>
  <tbody>
    @foreach ( $items as $item )
      <tr>
        <td class="block-title" data-label="Title">
          {{ $item->title }}
        </td>
        <td class="action align-center nowrap">
          <a class='button small' href="/video-types/{{ $item->id }}">view</a>
          <a class="button small" href="/video-types/{{ $item->id }}/edit">edit</a>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

@stop

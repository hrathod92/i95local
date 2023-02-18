<?php
  $page['title'] = 'Admin - Sponsoreds';
  $page['sideblocks'] = array( 'dashboard._block_admin' );
  $page['css'] = 'dashboard';
?>

@extends( 'templates.default' )
@section( 'content' )

<table class='blocks'>
  <thead>
    <tr>
      <th>Title</th>
      <th class="align-center">Action(s)</th>
    </tr>
  </thead>
  <tbody>
    @foreach ( $sponsoreds as $item )
      <tr>
        <td class="block-title" data-label="Title"><a href="/sponsoreds/{{ $item->id }}">{{ $item->title }}</a></td>
        <td class="action align-center nowrap">
          <a class='button small' href="/sponsoreds/{{ $item->id }}">view</a>
          <a class='button small' href="/sponsoreds/{{ $item->id }}/edit">edit</a>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

@stop

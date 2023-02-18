<?php
    $page['title'] = 'Admin - Feeds';
    $page['sideblocks'] = array( 'dashboard._block_admin' );
    $page['css'] = 'dashboard';
?>

@extends( 'templates.default' )
@section( 'content' )

<p><a class='button small icon-left' href='/feeds/create'><i class="fa fa-plus"></i>Create Feed</a></p>

<table class='blocks'>
  <thead>
    <tr>
      <th>Title</th>
      <th>Action(s)</th>
    </tr>
  </thead>
  <tbody>
    @foreach ( $feeds as $item )
      <tr>
        <td class="block-title"><a href="/feeds/{{ $item->id }}">{{ $item->title }}</a></td>
        <td class="nowrap align-center"><a class='button small' href='/feeds/{{ $item->id }}/edit'>edit</a></td>
      </tr>
    @endforeach
  </tbody>
</table>

@stop
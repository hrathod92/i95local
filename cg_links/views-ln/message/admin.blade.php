<?php
  $page['title'] = 'Admin - Messages';
  $page['sideblocks'] = array( 'dashboard._block_admin' );
  $page['css'] = 'dashboard';
?>

@extends( 'templates.default' )
@section( 'content' )

<p>
  <a class='button small icon-left' href='/messages/create'><i class="fa fa-plus"></i>Create Message</a>
</p>

<table class='blocks'>
  <thead>
    <tr>
      <th>Title</th>
      <th class="align-center">Action(s)</th>
    </tr>
  </thead>
  <tbody>
    @foreach ( $messages as $item )
      <tr>
        <td class="block-title" data-label="Title"><a href="/messages/{{ $item->id }}">{{ $item->title }}</a></td>
        <td class="action align-center nowrap">
          <a class='button small' href="/messages/{{ $item->id }}">view</a>
          <a class='button small' href="/messages/{{ $item->id }}/edit">edit</a>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

@stop

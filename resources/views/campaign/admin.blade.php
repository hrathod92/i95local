<?php
  $page['title'] = 'Admin - Campaigns';
  $page['sideblocks'] = array( 'dashboard._block_admin' );
  $page['css'] = 'dashboard';
?>

@extends( 'templates.default' )
@section( 'content' )

<p>
  <a class='button small icon-left' href='/campaigns/create'><i class="fa fa-plus"></i>Create Campaign</a>
</p>

<table class='blocks'>
  <thead>
    <tr>
      <th>Title</th>
      <th>Date</th>
      <th>Location</th>
      <th class="align-center" colspan="2">Action(s)</th>
    </tr>
  </thead>
  <tbody>
    @foreach ( $campaigns as $item )
      <tr>
        <td class="block-title" data-label="Title"><a href="/campaigns/{{ $item->id }}">{{ $item->title }}</a></td>
        <td class="nowrap align-center" data-label="Actions">
          <a class='button small' href='/campaigns/{{ $item->id }}/edit'>edit</a>
        </td>
        <td class="action align-center nowrap">
          <a class='button small' href="campaigns/{{ $item->id }}">view</a>
          <a class='button small' href="campaigns/{{ $item->id }}/edit">edit</a>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

@stop

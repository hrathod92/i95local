<?php
  $page['title'] = 'Admin - Releases';
  $page['sideblocks'] = array( 'release._block_admin','dashboard._block_admin' );
  $page['css'] = 'dashboard';
?>

@extends( 'templates.default' )
@section( 'content' )

<p>
  <a class='button small icon-left' href='/releases/create'><i class="fa fa-plus"></i>Create Release</a>
</p>

<table class='blocks'>
  <thead>
    <tr>
      <th class='align-center'>Type</th>
      <th class="align-center">Title</th>
      <th class="align-center">Company</th>
      <th class="align-center">Date</th>
      <th class="align-center">Status</th>
      <th class="align-center">Action(s)</th>
    </tr>
  </thead>
  <tbody>
    @foreach ( $releases as $item )
      <tr>
        @if(isset($item->release_type_id) && $item->release_type_id)
          <td class="block-title" data-label="Type"><a href="/releases/type/{{ $item->release_type_id }}">{{ $item->release_type['title'] }}</a></td>
        @else
          <td class="block-title" data-label="Type"></td>
        @endif
        <td class="block-title" data-label="Title"><a href="/releases/{{ $item->id }}">{{ $item->title }}</a></td>
        <td>{{isset($item->company->title) ? $item->company->title : "" }}</td>
        <td class="block-date align-center nowrap" data-label="Date"><a href="/releases/{{ $item->id }}">{{ date( 'M d, Y', strtotime( $item->pub_date )) }}</a></td> 
        <td class="block-title" data-label="Title"><a href="/releases/{{ $item->id }}">{{ $item->status['title'] }}</a></td>
        <td class="action align-center nowrap">
          <a class='button small' href="/releases/{{ $item->id }}">view</a>
          <a class='button small' href="/releases/{{ $item->id }}/edit">edit</a>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

@stop

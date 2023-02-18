<?php
  $page['title'] = 'Admin - Publications';
  $page['sideblocks'] = array( 'dashboard._block_admin' );
  $page['css'] = 'dashboard';
?>

@extends( 'templates.default' )
@section( 'content' )

<p>
  <a class='button small icon-left' href='/newsletters/create'><i class="fa fa-plus"></i>Create Newsletter</a>
</p>

<table class='blocks'>
  <thead>
    <tr>
      <th class="align-center" colspan=2>Edition</th>
      <th class="align-center">Status</th>
      <th class="align-center" colspan="2">Action(s)</th>
    </tr>
  </thead>
  <tbody>
    @foreach ( $newsletters as $item )
      <tr>
        <td class="block-year" data-label="Title"><a href="/newsletters/{{ $item->id }}">{{ date( 'Y', strtotime( $item->title )) }}</a></td>
        <td class="block-month" data-label="Title"><a href="/newsletters/{{ $item->id }}">{{ date( 'F', strtotime( $item->title )) }}</a></td>
        <td class="block-status align-center" data-label="Title"><a href="/newsletters/{{ $item->id }}">{{ $item->status['title'] }}</a></td>
        <td class="action align-center nowrap">
          <a class='button small' href="/newsletters/{{ $item->id }}">view</a>
          <a class='button small' href="/newsletters/{{ $item->id }}/edit">edit</a>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

@stop

<?php
  use \App\Helpers\Display;
  $page['title'] = 'Admin - Job Emails';
  $page['sideblocks'] = array( 'job._block_admin','dashboard._block_admin' );
  $page['css'] = 'dashboard';
?>

@extends( 'templates.default' )
@section( 'content' )

<table class='blocks'>
  <thead>
    <tr>
      <th class="align-center">Email</th>
      <th class="align-center">Date</th>
    </tr>
  </thead>
  <tbody>
    @foreach ( $items as $item )
      <tr>
        <td>{{ $item->email }}</td>
        <td class="align-center">{{ Display::dateStd( $item->created_at ) }}</td>
      </tr>
    @endforeach
  </tbody>
</table>

@stop

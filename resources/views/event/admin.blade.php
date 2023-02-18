<?php
  use \App\Helpers\Display;
  $page['title'] = 'Admin - Events';
  $page['sideblocks'] = array('event._block_admin', 'dashboard._block_admin' );
  $page['css'] = 'dashboard';
?>

@extends( 'templates.default' )
@section( 'content' )

<p style="text-align:center; color:#06367d;">
  <span class="pull-left"><a class='button small icon-left' href='/events/admin-create'><i class="fa fa-plus"></i>Create Event</a></span>
  {!! $checked > 0 ? $alert : '</br>' !!}
</p>

<table class='blocks'>
  <thead>
    <tr>
      <th class='align-center'>Type</th>
      <th class='align-center'>Title</th>
      <th class='align-center'>Date</th>
      <th class='align-center'>Status</th>
      <th class='align-center'>Action(s)</th>
    </tr>
  </thead>
  <tbody>
    @foreach ( $events as $item )
      <tr>
        <td class="block-type nowrap"><a href="/events/{{ $item->id }}">{{ $item->event_type['title'] }}</a></td>
        <td class="block-title"><a href="/events/{{ $item->id }}">{{ $item->title }}</a></td>
        <td class="block-date align-center nowrap"><a href="/events/{{ $item->id }}">{{ Display::dateStd( $item->starts_at ) }}</a></td>
        <td class="block-status align-center"><a href="/events/{{ $item->id }}">{{ $item->status['title'] }}</a></td>
        <td class="nowrap align-center"><a class='button small' href='/events/{{ $item->id }}/edit'>edit</a></td>
      </tr>
    @endforeach
  </tbody>
</table>
@if($checked > 0)
  <p>{{ $checked}} record(s) updated</p>
@endif
@stop

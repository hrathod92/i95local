<?php
  use \App\Helpers\Display;
  $page['title'] = 'Company - Events';
  $page['sideblocks'] = array( 'event._block_company', 'dashboard._block_user' );
  $page['css'] = 'dashboard';
?>

@extends( 'templates.default' )
@section( 'content' )

<p><a class='button small icon-left' href='/events/create'><i class="fa fa-plus"></i>Create Event</a></p>

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
    <?php
     if(!empty($item->slug)){
       $url = '/events/show/'.$item->slug;
     }else{
       $url = '/events/'.$item->id;
     }
    ?>
      <tr>
        <td class="block-type"><a href="{{ $url }}">{{ $item->event_type['title'] }}</a></td>
        <td class="block-title"><a href="{{ $url }}">{{ $item->title }}</a></td>
        <td class="block-date align-center"><a href="{{ $url }}">{{ Display::dateStd( $item->starts_at ) }}</a></td>
        <td class="block-status align-center"><a href="{{ $url }}">{{ $item->status['title'] }}</a></td>
        <td class="nowrap align-center"><a class='button small' href='/events/{{ $item->id }}/edit'>edit</a></td>
      </tr>
    @endforeach
  </tbody>
</table>

@stop
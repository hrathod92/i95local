<?php
  $page['title'] = 'Releases / ' . $company->title;
  $page['sideblocks'] = [ 'dashboard._block_user' ];    
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
    <th class="align-center">Date</th>
    <th class="align-center">Status</th>
    <th class="align-center">Action</th>
  </tr>
  </thead>
  <tbody>
    @foreach ( $items as $item )
      <?php $viewUrl = route( 'releases.show', $item->id ); ?>
      <tr>
        <td class="block-title" data-label="Type">{{$item->release_type->title}}</td>
        <td class="block-title" data-label="Title"><a href="{{$viewUrl}}">{{ $item->title }}</a></td>
        <td class="block-date align-center nowrap" data-label="Date"><a href="{{$viewUrl}}">{{ date( 'M d, Y', strtotime( $item->pub_date )) }}</a></td>
        <td class="status align-center nowrap" data-label="Status">
            <a href="{{$viewUrl}}">{{ $item->status->title }}</a>
        </td>
        <td class="action align-center nowrap">
          <a class='button small' href="{{route('releases.edit', $item->id )}}">edit</a>
          <a class='button small' href="{{route('releases.show', $item->id )}}">show</a>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

@stop

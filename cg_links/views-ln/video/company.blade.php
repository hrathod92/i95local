<?php
  $title = 'Videos';
  if ( !empty( $company )) $title .= ' / ' . $company->title;
  $page['title'] = $title; 
  $page['sideblocks'] = [ 'dashboard._block_user' ];    
  $page['css'] = 'videos'; 

?>

@extends( 'templates.default' )
@section( 'content' )

<div class='buttons'><a class='button' href='/videos/create'>Create</a></div>
<br />

<table class='videos'>
  <tr>
    <th class='align-center'>Type</th>
    <th class='align-center'>Title</th>
    <th class="align-center">Status</th>
    <th class='align-center'>Action</th>
  </tr>
  @foreach ( $items AS $item )
    <?php $viewUrl = route( 'videos.show', $item->id ); ?>
    <tr class="video">
      <td class="block-title" data-label="Type">{{!empty($item['video_type']) ? $item['video_type']->title : null }}</td>
      <td class="video-title"><a href="{{$viewUrl}}">{{ $item->title }}</a></td>
      <td class="status align-center nowrap" data-label="Status">
        <a href="{{$viewUrl}}">{{ $item->status->title }}</a>
      </td>
      <td class="video-action align-center nowrap">
          <a class='button small' href="{{ route('videos.edit', $item->id )}}">edit</a>
          <a class='button small' href="{{ route('videos.show', $item->id )}}">show</a>
      </td>
    </tr>
  @endforeach
</table>

@stop

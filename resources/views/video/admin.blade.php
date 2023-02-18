<?php $page['title'] = 'Videos - Admin'; ?>
<?php $page['sideblocks'] = [ 'dashboard._block_admin' ]; ?>
<?php $page['css'] = 'videos'; ?>

@extends( 'templates.default' )
@section( 'content' )

<div class='buttons'><a class='button' href='/videos/create'>Create</a></div>
<br />

<table class='videos'>
  <tr>
    <th class='align-center'>Company</th>
    <th class='align-center'>Title</th>
    <th class='align-center'>Type</th>
    <th class='align-center'>Favorite</th>
    <th class='align-center'>Status</th>
    <th class='align-center'>Action(s)</th>
  </tr>
  @foreach ( $videos AS $video )
      <tr class="video">
        <td class="video-title"><a href="/videos/show/{{ $video->id }}">{{ $video->company['title'] }}</a></td>
        <td class="video-title"><a href="/videos/show/{{ $video->id }}">{{ $video->title }}</a></td>
        <td class="video-fav align-center"><a href="/videos/show/{{ $video->id }}">{{ $video->video_type['title'] }}</a></td>
        <td class="video-fav align-center"><a href="/videos/show/{{ $video->id }}">{{ $video->favorite['title'] }}</a></td>
        <td class="video-status align-center"><a href="/videos/show/{{ $video->id }}">{{ $video->status['title'] }}</a></td>
        <td class="video-action align-center">
          <a class='button small' href="/videos/{{ $video->id }}">view</a>
          <a class='button small' href="/videos/{{ $video->id }}/edit">edit</a>
        </td>         
      </tr>
  @endforeach
</table>

@stop
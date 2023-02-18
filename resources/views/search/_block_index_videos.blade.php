<?php
  $query = \App\Video::with( 'video_type' )->where( 'status_id', 0 );
  if ( !empty( $terms )) $query = $query->search( $terms );
  $videos = $query->orderBy( 'id', 'DESC' )->take( 10 )->get();
?>

<h2>Videos</h2>
<div class='search-videos search-group'>
  @if ( $videos->count() )
    @foreach ( $videos AS $video )
      <div class='search-video'>
        <div class="title" data-label="Title"><a href="/videos/{{ $video->id }}">{{ $video->title }}</a></div>
      </div>
    @endforeach
  @else
    <div class='article'>
      <div class="title" data-label="Title">No search results found.</div>
    </div>
  @endif
</div>

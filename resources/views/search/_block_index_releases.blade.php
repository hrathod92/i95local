<?php
  $query = \App\Release::with( 'release_type' );
  if ( !empty( $terms )) $query = $query->search( $terms );
  $releases = $query->orderBy( 'id', 'DESC' )->take( 10 )->get();
?>

<h2>Press Releases</h2>
<div class='search-releases search-group'>
  @if ( $releases->count() )
    @foreach ( $releases AS $release )
      <div class='search-release'>
        <div class="title" data-label="Title"><a href="/releases/{{ $release->id }}">{{ $release->title }} ({{ date( 'M d, Y', strtotime( $release->created_at )) }})</a></div>
      </div>
    @endforeach
  @else
    <div class='article'>
      <div class="title" data-label="Title">No search results found.</div>
    </div>
  @endif
</div>

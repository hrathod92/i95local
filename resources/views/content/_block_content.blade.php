<?php $sideblocks = App\Block::where( 'slug', '=', 'sidebar-content' )->orderBy( 'slug' )->get(); ?>

<div class='content-sidebar'>
 
  <h2>More Info</h2>

  @foreach ( $sideblocks AS $sideblock )
    <div class='content-sidebar-block {!! $sideblock->class !!}' id='{{ $sideblock->slug }}'>
      {!! $sideblock->body !!}
    </div>
  @endforeach

</div>
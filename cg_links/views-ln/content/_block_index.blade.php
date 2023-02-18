<?php $sideblocks = App\Block::where( 'type', '=', 'sidebar' )->orderBy( 'slug')->get(); ?>
@foreach ( $sideblocks AS $sideblock )
  <div class='sidebar-block {!! $sideblock->class !!}' id='{{ $sideblock->slug }}'>
    {!! $sideblock->body !!}
  </div>
@endforeach

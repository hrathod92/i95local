<?php $blockVideos = App\Video::all(); ?>
<ul>
  @foreach ( $blockVideos AS $blockVideo )
    <li><a href='/videos/{{ $blockVideo->id }}'>{{ $blockVideo->title }}</a></li>
  @endforeach
</ul>

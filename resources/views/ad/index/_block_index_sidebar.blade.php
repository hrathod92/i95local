<?php $blockAdTypes = \App\AdType::orderBy( 'title' )->get(); ?>
<h2>Type</h2>
<ul>
  @foreach ( $blockAdTypes AS $blockAdType )
    <li><a href='/ads?ad_type_id={{ $blockAdType->id }}'>{{ $blockAdType->title }}</a></li>
  @endforeach
</ul>

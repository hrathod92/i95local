<?php $blockCategories = App\Category::orderBy( 'title' )->get(); ?>
<h3>Categories</h3>
<ul class="sidebar-menu">
  <li><a href='/articles'>All</a></li>
  @foreach ( $blockCategories AS $blockCategory )
    <li><a href='/articles/index/{{ $blockCategory->id }}'>{{ $blockCategory->title }}</a></li>
  @endforeach
</ul>
  
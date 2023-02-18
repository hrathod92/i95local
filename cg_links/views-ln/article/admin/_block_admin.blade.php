<?php 
  $blockCategories = App\Category::orderBy( 'title' )->get();
  $blockArticles = DB::table( 'articles' )
                 ->select( 'category_id', DB::raw( 'count(*) as total' ))
                 ->groupBy('category_id')
                 ->lists( 'total', 'category_id' );
?>
<h3>Categories</h3>
<ul class="dashboard-menu">
  <li><a href='/articles/admin'>All</a></li>
  @foreach ( $blockCategories AS $blockCategory )
    <?php $blockProductCount = isset( $blockArticles[$blockCategory->id] ) ? '(' . $blockArticles[$blockCategory->id] . ')' : ''; ?>
    <li><a href='/articles/admin/{{ $blockCategory->id }}'>{{ $blockCategory->title }} {{ $blockProductCount }}</a></li>
  @endforeach
</ul>

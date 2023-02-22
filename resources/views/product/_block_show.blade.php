<?php 
  $blockCategories = App\Category::orderBy( 'title' )->get();
  $blockProducts = DB::table( 'products' )
                 ->select( 'category_id', DB::raw( 'count(*) as total' ))
                 ->groupBy('category_id')
                 ->pluck( 'total', 'category_id' );
?>
<h2>Categories</h2>
<ul>
  <li><a href='/products'>All</a></li>
  @foreach ( $blockCategories AS $blockCategory )
    <?php $blockProductCount = isset( $blockProducts[$blockCategory->id] ) ? '(' . $blockProducts[$blockCategory->id] . ')' : ''; ?>
    <li><a href='/products/index/{{ $blockCategory->id }}'>{{ $blockCategory->title }} {{ $blockProductCount }}</a></li>
  @endforeach
</ul>

<?php
  $query = \App\Article::with( 'category' )->publishedAndActive();
  if ( !empty( $terms )) $query = $query->searchWithCompanyAuthor( $terms );
  $articles = $query->orderBy( 'pub_date', 'DESC' )->take( 10 )->get();
?>

<h2>Articles</h2>
<div class='search-articles search-group'>
  @if ( $articles->count() )
    @foreach ( $articles AS $article )
      <div class='search-article'>
        <div class="title" data-label="Title"><a href="/articles/{{ $article->id }}">{{ $article->title }} ({{ date( 'M d, Y', strtotime( $article->pub_date )) }})</a></div>
      </div>
    @endforeach
  @else
    <div class='article'>
      <div class="title" data-label="Title">No search results found.</div>
    </div>
  @endif
</div>

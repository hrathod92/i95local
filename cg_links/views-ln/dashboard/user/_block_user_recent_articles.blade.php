<?php
  $articles = \App\Article::with('category')
    ->where( 'company_id', \Auth::user()->company_id )
    ->orderBy( 'id', 'DESC' )
    ->take(3)
    ->get();
?>

<div class='dashboard-block dashboard-articles'>
    <h2>Recent Articles</h2>
    @if ( $articles->count() )
        @foreach ( $articles AS $article )
            <div class='search-article'>
                <div class="title" data-label="Title">
                    <a href="{{ route( 'articles.show', $article->id ) }}">
                      <span>{{ $article->category['title'] }}</span>
                      <span>{{ date( 'M d, Y', strtotime( !empty( $article->pub_date ) ? $article->pub_date : $article->created_at )) }}</span>
                      <span>{{ $article->title }}</span>
                    </a>
                </div>
            </div>
        @endforeach
    @else
        <div class='dashboard-empty'>
            <div class="title" data-label="Title">No results found.</div>
        </div>
    @endif
    <div class='read-more'></div><a class='button small' href="/articles/company">Read More</a>
</div>

<style>
  .dashboard-block span {
    display: inline-block;
  }
  .dashboard-block span:nth-child(1) {
    width: 10em;
  }
  .dashboard-block span:nth-child(2) {
    width: 10em;
  }
  .dashboard-block .read-more {
    margin-top: 1em;
  }
  .dashboard-block .read-more a {
    padding: 0.15em 1em;
  }
</style>

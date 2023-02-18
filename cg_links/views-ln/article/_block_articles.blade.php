<?php $articles = App\Article::orderBy( 'day', 'DESC' )->take(20)->get(); ?>

<div class="sidebar-block border-left-gray padding styled-list margin-bottom recent-news-block">
  <div class="block-title">Recent News</div>
  <ul>
    @foreach ( $articles AS $article )
      <li><a href='/articles/content/{{ $article->slug }}'>{{ $article->title }}</a></li>
    @endforeach  
  </ul>
</div>

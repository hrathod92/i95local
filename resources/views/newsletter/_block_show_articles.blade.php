<?php $blockArticles = isset($id) ? \App\Article::where( 'newsletter_id', $id )->orderBy( 'title' )->get() : null; ?>

@if ( $blockArticles && $blockArticles->count() )
  <div class='newsletter-articles-wrapper'>
    <h2>Inside This Edition</h2>
      @if ( $blockArticles->count() )
        <ul class='newsletter-articles'>
          @foreach ( $blockArticles AS $blockArticle )
            <li class='newsletter-article'><a href='/articles/content/{{ $blockArticle->slug }}'>{{ $blockArticle->title }}</a></li>
          @endforeach
        </ul>
      @endif
      <br />
  </div>
@endif

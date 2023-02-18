<?php 
	$articles = App\Article::with( 'category', 'click' )
		->publishedAndActive()
		->where( 'company_id', $id )
		->orderBy( 'id', 'DESC' )
		->take(30)
		->get(); 
?>

<div class="latest-articles">
	<h2>Latest Articles</h2>
    @foreach ( $articles AS $article )
      <div class="article">
        <div class="text-wrapper">
          <span class="taxonomy"><a href="/articles/category/{{ $article->category['slug'] }}">{{ $article->category['title'] }}</a></span>
					@if ( isset( $article->click->click_count ) && $article->click->click_count > 5 )
						<span class="shares{{ $article->click->click_count > 10 ? ' hot' : '' }}">
							<i class="material-icons">whatshot</i> {{ $article->click->click_count }}
						</span>
					@endif
          <div class="title"><a href="/articles/content/{{ $article->slug }}">{{ $article->title }}</a></div>
        </div>
      </div>
    @endforeach  
</div>

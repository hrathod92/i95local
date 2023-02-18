<?php
	if ( !empty( $category )) {
		if ( $category->parent_id != 0 && ( $category->parent_id != $category->id ) && !empty( $category->parent )) {
  		$page['title'] = ucwords( htmlspecialchars( $category->parent['title']  )) . ' / ' . ucwords( htmlspecialchars( $category->title ));
		} else {
  		$page['title'] = ucwords( htmlspecialchars( $category->title ));
		}
	} else {
  	$page['title'] = 'All Expertises';
	}
  $page['sideblocks'] = [ 'article.index._block_index', 'article.ads._block_article_ad_side' ];
  $page['css'] = 'news';
?>

<?php $intro = \App\Content::where( 'slug', '=', 'articles' )->first(); ?>

@extends( 'templates.default' )
@section('head')
	<meta property="og:url"           content="{{ Request::fullUrl() }}" />
  	<meta property="og:type"          content="website" />
  	<meta property="og:title"         content="{{ $page['title']}} | I95 Business" />
  	<meta property="og:description"   content="{{ $page['title']}} | I95 Business" />
  	<meta property="og:image"         content="{{ count($items) > 0  ? url('/').'/data/newsletters/img/'.$items[0]->image : null }}" />
<title>{{ $page['title']}} | I95 Business</title>
@endsection
@section( 'content' )

@include( 'article.index._block_index_features' )

@include( 'article.ads._block_article_ad_header' )

@include( 'article.index._block_index_filter' )

<div class='articles-list'> 
	@if ( count($items) > 0 )
		@foreach ( $items AS $article )
			<div class='article'>
				<div class="text-wrapper">
					<span class="taxonomy category" data-label="Category">{!! $article->getCatStrWithAnchors() !!}</span>
					@if ( isset( $article->click->click_count ) && $article->click->click_count > 5 )
						<span class="shares{{ isset( $article->click->click_count ) && $article->click->click_count > 10 ? ' hot' : '' }}">
							<i class="material-icons">whatshot</i>
							{{ isset( $article->click->click_count ) ? $article->click->click_count : 0 }}
						</span>
					@endif
					<div class="title" data-label="Title"><a href="/articles/content/{{ $article->slug }}">{{ $article->title }}</a></div>
					<div class='pub_date'>{{ date( 'M d, Y', strtotime( $article->pub_date)) }}</div>
				</div>
			</div>
		@endforeach
	@else
		<div class="article-empty" data-label="Empty">No articles found.  Please select another category or search term.</div>
	@endif
</div>

@include( 'article.ads._block_article_ad_info' )

<style>
  .article-feature-wrapper .feature .image-wrapper .image-crop img {
    max-height: 100%;
    height: auto;
  }
</style>

@stop
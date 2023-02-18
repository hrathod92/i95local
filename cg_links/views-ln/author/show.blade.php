<?php 
	$page['title'] = 'Author - ' . $title;
  $page['sideblocks'] = array( 'ad._block_ads_side' );
	$page['css'] = 'authors'; 
?>

@extends( 'templates.default' )
@section( 'content' )

<div class='author-info'>
	@if ( !empty( $image ))
		<div class='main-author-image'>
			<img src="/data/authors/img/{{ $image }}?ut={{ str_replace( ' ', '-', $updated_at ) }}" alt="Picture of{{ $title }}">
			@if ( !empty( $image_caption ))
				<div class='image-caption'>{{ $image_caption }}</div>
			@endif
		</div>
		<div class='main-author-text'>
			<p>{!! nl2br( $body ) !!}</p>
	</div>
	@endif
</div>

<?php $authorArticles = App\Article::with( 'category' )->where( 'author_id', $id )->orderBy( 'id', 'DESC' )->get(); ?>
@if ( $authorArticles->count() )
	<div class="latest-articles">
		<h2>Articles by Author</h2>
		@foreach ( $authorArticles AS $authorArticle )
			<div class="article">
				<div class="text-wrapper">
					<div class="taxonomy"><a href="/articles/category/{{ $authorArticle->category['slug'] }}">{{ $authorArticle->category['title'] }}</a></div>
					<div class="title"><a href="/articles/{{ $authorArticle->id }}">{{ $authorArticle->title }}</a></div>
				</div>
			</div>
		@endforeach
	</div>
@endif

@if ( Auth::check() && Auth::user()->role == 'admin' )
    <p><a class='button' href='/authors/{{ $id }}/edit'>edit</a></p>
@endif

<style>
	.main-author-image {
		float: left;
		margin: 0 1em 1em 0;
		width: 15%;
	}
	.main-author-image img {
		width: 100%;
	}
	.main-author-text {
		margin-left: 17%;
	}
	
</style>

@stop
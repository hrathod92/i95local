<?php 
	$blockMores = \App\Article::with( 'category', 'click' )
		->publishedAndActive()
		->where( 'more_id', 0 )
		->orderBy( 'id', 'DESC' )
		->take(6)
		->get();
	$blockMores = $blockMores->merge( \App\Article::with( 'category', 'click' )
		->publishedAndActive()
		->orderBy( 'id', 'DESC' )
		->take( 6 - $blockMores->count() )
		->get() );
?>

<div class='more-articles-wrapper'>
	<h2>More Articles</h2>
	<div class="more-articles">

	@foreach ( $blockMores AS $blockMore )
		<div class="article">
			<a href="/articles/content/{{ $blockMore->slug }}">
			<div class="image-wrapper">
				<div class="image-crop">
					<img src="/data/articles/img/{{ $blockMore->image }}" alt='{{ $blockMore->title }}'>
				</div>
			</div>
			</a>
			<div class="text-wrapper">
				<span class="taxonomy">{!! $blockMore->getCatWithAnchor() !!}</span>
				@if ( isset( $blockMore->click->click_count ) && $blockMore->click->click_count > 5 )
					<span class="shares{{ $blockMore->click->click_count > 10 ? ' hot' : '' }}">
						<i class="material-icons">whatshot</i> {{ $blockMore->click->click_count }}
					</span>
				@endif
				<div class="title"><a href="/articles/content/{{ $blockMore->slug }}">{{ $blockMore->title }}</a></div>
			</div>
		</div>
	@endforeach
		
	</div>
	
	<div class="medium-rectangle-banners">
		<?php
			$blockSide = App\Helpers\AdSelect::get( 15 );
		?>
		@if(is_array($blockSide) && count($blockSide) > 0)
		  <div class='{{ $blockSide->class }} ad'>
			<a href="{{ $blockSide->ad_url }}" data-ad-id="{{ $blockSide->id }}" class="ad-click-tracking" target="_blank"><img src='/data/ads/img/{!! $blockSide->image !!}'  alt='{{ $blockSide->title }}'/></a>
		  </div>
		@endif

		<?php
			$blockSideB = App\Helpers\AdSelect::get( 16 );
		?>
		@if(is_array($blockSideB) && count($blockSideB) > 0)
		  <div class='{{ $blockSideB->class }} ad'>
			<a href="{{ $blockSideB->ad_url }}" data-ad-id="{{ $blockSideB->id }}" class="ad-click-tracking" target="_blank"><img src='/data/ads/img/{!! $blockSideB->image !!}'  alt='{{ $blockSideB->title }}'/></a>
		  </div>
		@endif
	</div>
</div>
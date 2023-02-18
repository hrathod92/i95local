<?php 
	$blockTops = \App\Article::with( 'category', 'click' )
		->where( 'top_id', '>', 0 )
		->publishedAndActive()
		->orderBy( 'top_id' )
		->take(5)
		->get();
	$blockTops = $blockTops->merge( \App\Article::with( 'category', 'click' )
		->publishedAndActive()
		->orderBy( 'id', 'DESC' )
		->take(5)
		->get() );
?>

<div class='top-articles-wrapper'>
	<h2>Top Articles</h2>
	
	<div class="top-feature">
		<div class="article">
			<a href="/articles/content/{{ $blockTops[0]->slug }}">
			<div class="image-wrapper">
				<div class="image-overlay"></div>
				<div class="image-crop">
					<img src="/data/articles/img/{{ $blockTops[0]->image }}" alt="{{ $blockTops[0]->caption }}">
				</div>
			</div>
			<div class="text-wrapper">
				
				<span class="taxonomy">{!! $blockTops[0]->getCatWithAnchor() !!}</span>
				@if ( isset($blockTops[0]->click->click_count ) && $blockTops[0]->click->click_count > 5 )
					<span class="shares{{ $blockTops[0]->click->click_count > 10 ? ' hot' : '' }}">
						<i class="material-icons">whatshot</i> {{ $blockTops[0]->click->click_count }}
					</span>
				@endif
				<div class="title"><a href="/articles/content/{{ $blockTops[0]->slug }}">{{ $blockTops[0]->title }}</a></div>
				
			</div>
			</a>
		</div>
	</div>
	
	<div class="top-articles">
		@for ( $id = 1; $id < 5; $id++ )
			<div class="article">
		<a href="/articles/content/{{ $blockTops[$id ]->slug }}">
				<div class="image-wrapper">
					<div class="image-crop">
						<img src="/data/articles/img/{{ $blockTops[$id ]->image }}" alt="{{ $blockTops[$id ]->caption }}">
					</div>
				</div>
		</a>
				<div class="text-wrapper">
					<span class="taxonomy">{!! $blockTops[$id]->getCatWithAnchor() !!}</a></span>
					@if ( isset( $blockTops[$id]->click->click_count ) && $blockTops[$id]->click->click_count > 5 )
						<span class="shares{{ $blockTops[$id]->click->click_count > 10 ? ' hot' : '' }}">
							<i class="material-icons">whatshot</i> {{ $blockTops[$id]->click->click_count }}
						</span>
					@endif
					<div class="title"><a href="/articles/content/{{ $blockTops[$id ]->slug }}">{{ $blockTops[$id ]->title }}</a></div>
				</div>
			</div>
		@endfor
		
	</div>
</div>

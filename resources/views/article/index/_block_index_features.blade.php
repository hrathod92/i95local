<?php
	if ( $slug != '' && $slug != 'all' ) {
		$blockFeatures = \App\Article::with( 'category', 'click' )
			->Feature()
			->where( 'category_id', $categoryID )
			->orderBy( 'id', 'DESC' )
			->take(5)
			->get();
		if ( $blockFeatures->count() < 5 ) {
			$blockFeatures = $blockFeatures->merge( \App\Article::with( 'category', 'click' )
				->Feature()
				->where( 'category_2_id', $categoryID )
				->orderBy( 'id', 'DESC' )
				->take(5)
				->get() 
			);
		}
		if ( $blockFeatures->count() < 5 ) {
			$blockFeatures = $blockFeatures->merge( \App\Article::with( 'category', 'click' )
				->Feature()
				->where( 'category_3_id', $categoryID )
				->orderBy( 'id', 'DESC' )
				->take(5)
				->get() 
			);
		}
		if ( $blockFeatures->count() < 5 ) {
			$blockFeatures = $blockFeatures->merge( \App\Article::with( 'category', 'click' )
				->Feature()
				->where( 'category_4_id', $categoryID )
				->orderBy( 'id', 'DESC' )
				->take(5)
				->get() 
			);
		}
		if ( $blockFeatures->count() < 5 ) {
			$blockFeatures = $blockFeatures->merge( \App\Article::with( 'category', 'click' )
				->Feature()
				->where( 'category_5_id', $categoryID )
				->orderBy( 'id', 'DESC' )
				->take(5)
				->get() 
			);
		}
		if ( $blockFeatures->count() < 5 ) {
			$blockFeatures = $blockFeatures->merge( \App\Article::with( 'category', 'click' )
				->Feature()
				->orderBy( 'id', 'DESC' )
				->take(5)
				->get() 
			);
		}
	} else {
		$blockFeatures = \App\Article::with( 'category', 'click' )
			->Feature()
			->orderBy( 'id', 'DESC' )
			->take(5)
			->get();
	}
?>

<div class="article-feature-wrapper">
	
	<div class="feature feature-small feature-{{ $blockFeatures[0]->id }}">
		<a href="/articles/content/{{ $blockFeatures[0]->slug }}">
			<div class="image-wrapper">
			<div class="image-overlay"></div>
			<div class="image-crop">
					<img src="/data/articles/img/{{ $blockFeatures[0]->image }}" alt="Image: {{ $blockFeatures[0]->tagline }}">
				</div>
		</div>
		<div class="text-wrapper">
			<span class="taxonomy">{!! $blockFeatures[0]->getCatWithAnchor() !!}</span>
			@if ( isset( $blockFeatures[0]->click->click_count ) && $blockFeatures[0]->click->click_count > 5 )
				<span class="shares{{ $blockFeatures[0]->click->click_count > 10 ? ' hot' : '' }}">
					<i class="material-icons">whatshot</i>{{ $blockFeatures[0]->click->click_count }}
				</span>
			@endif
			<div class="title"><a href="/articles/content/{{ $blockFeatures[0]->slug }}">{{ $blockFeatures[0]->title }}</a></div>
		</div>
		</a>
	</div>
	
	<div class="feature feature-small feature-{{ $blockFeatures[1]->id }}">
		<a href="/articles/content/{{ $blockFeatures[1]->slug }}">
		<div class="image-wrapper">
			<div class="image-overlay"></div>
			<div class="image-crop">
					<img src="/data/articles/img/{{ $blockFeatures[1]->image }}" alt="Image: {{ $blockFeatures[1]->tagline }}">
				</div>
		</div>
		<div class="text-wrapper">
			<span class="taxonomy">{!! $blockFeatures[1]->getCatWithAnchor() !!}</span>
			@if ( isset( $blockFeatures[1]->click->click_count ) && $blockFeatures[1]->click->click_count > 5 )
				<span class="shares{{ $blockFeatures[1]->click->click_count > 10 ? ' hot' : '' }}">
					<i class="material-icons">whatshot</i> {{ $blockFeatures[1]->click->click_count }}
				</span>
			@endif
			<div class="title"><a href="/articles/content/{{ $blockFeatures[1]->slug }}">{{ $blockFeatures[1]->title }}</a></div>
		</div>
		</a>
	</div>
	
	@for ( $i=2; $i<=4; $i++ )
		<div class="feature feature-tiny feature-{{ $blockFeatures[$i]->id }}">
			<a href="/articles/content/{{ $blockFeatures[$i]->slug }}">
			<div class="image-wrapper">
				<div class="image-overlay"></div>
				<div class="image-crop">
						<img src="/data/articles/img/{{ $blockFeatures[$i]->image }}" alt="Image: {{ $blockFeatures[3]->tagline }}">
					</div>
			</div>
			<div class="text-wrapper">
				<span class="taxonomy">{!! $blockFeatures[$i]->getCatWithAnchor() !!}</span>
				@if ( isset( $blockFeatures[$i]->click->click_count ) && $blockFeatures[$i]->click->click_count > 5 )
					<span class="shares{{ $blockFeatures[$i]->click->click_count > 10 ? ' hot' : '' }}">
						<i class="material-icons">whatshot</i> {{ $blockFeatures[$i]->click->click_count }}
					</span>
				@endif
				<div class="title"><a href="/articles/content/{{ $blockFeatures[$i]->slug }}">{{ $blockFeatures[$i]->title }}</a></div>
			</div>
			</a>
		</div>
	@endfor

</div>

<style>
	@foreach( $blockFeatures AS $blockFeature )
		{!! $blockFeature->css_blocks !!}
	@endforeach
	.article-feature-wrapper .feature .image-wrapper .image-crop {
	}
	.article-feature-wrapper .feature .image-wrapper .image-crop img {
			left: 0;
			right: 0;
			margin: 0 auto;
			width: auto;
			height: 100%;
			object-fit: contain;
	}
</style>

<?php 
	$blockFeatures = \App\Article::with( 'category', 'click' )
		->where( 'featured_id', '>', 0 )
		->publishedAndActive()
		->orderBy( 'featured_id' )
		->orderBy( 'id', 'DESC' )
		->take(3)
		->get(); 
	$blockFeatures = $blockFeatures->merge( \App\Article::with( 'category', 'click' )
		->publishedAndActive()
		->orderBy( 'id', 'DESC' )
		->take(3)
		->get() );
?>

<div id="banner">
	<div id="banner-inner">
    
		<div class="home-feature-wrapper">
			
			<div class="feature feature-large feature-{{ $blockFeatures[0]->id }}">

				<a href="/articles/content/{{ $blockFeatures[0]->slug }}">
				<div class="image-wrapper">
					<div class="image-overlay"></div>
					<div class="image-crop">
							<img src="/data/articles/img/{{ $blockFeatures[0]->image }}" alt="{{ $blockFeatures[0]->title }}">
				</div>
				</div>
				</a>

				<div class="text-wrapper">
					<span class="taxonomy">{!! $blockFeatures[0]->getCatWithAnchor() !!}</span>
					@if ( isset( $blockFeatures[0]->click->click_count ) && $blockFeatures[0]->click->click_count > 5 )
						<span class="shares{{ $blockFeatures[0]->click->click_count > 10 ? ' hot' : '' }}">
							<i class="material-icons">whatshot</i>{!! $blockFeatures[0]->click->click_count !!}
						</span>
					@endif
					<div class="title"><a href="/articles/content/{{ $blockFeatures[0]->slug }}">{{ $blockFeatures[0]->title }}</a></div>
				</div>
			</div>
      
			<div class="feature feature-small feature-{{ $blockFeatures[1]->id }}">
				<a href="/articles/content/{{ $blockFeatures[1]->slug }}">
					<div class="image-wrapper">
						<div class="image-overlay"></div>
						<div class="image-crop">
						<img src="/data/articles/img/{{ $blockFeatures[1]->image }}" alt="{{ $blockFeatures[1]->title }}">
					</div>
					</div>
				</a>

				<div class="text-wrapper">
					<span class="taxonomy">{!! $blockFeatures[1]->getCatWithAnchor() !!}</span>
					@if ( isset( $blockFeatures[1]->click->click_count ) && $blockFeatures[1]->click->click_count > 5 )
						<span class="shares{{ $blockFeatures[1]->click->click_count > 10 ? ' hot' : '' }}">
							<i class="material-icons">whatshot</i> {{$blockFeatures[1]->click->click_count }}
						</span>
					@endif
					<div class="title"><a href="/articles/content/{{ $blockFeatures[1]->slug }}">{{ $blockFeatures[1]->title }}</a></div>
				</div>
			</div>
      
			<div class="feature feature-small feature-{{ $blockFeatures[2]->id }}">
				<a href="/articles/content/{{ $blockFeatures[2]->slug }}">
					<div class="image-wrapper">
						<div class="image-overlay"></div>
						<div class="image-crop">
						<img src="/data/articles/img/{{ $blockFeatures[2]->image }}" alt="{{ $blockFeatures[2]->title }}">
					</div>
					</div>
				</a>
				<div class="text-wrapper">
					<span class="taxonomy">{!! $blockFeatures[2]->getCatWithAnchor() !!}</span>
					@if ( isset( $blockFeatures[2]->click->click_count ) && $blockFeatures[2]->click->click_count > 5 )
						<span class="shares{{ $blockFeatures[2]->click->click_count > 10 ? ' hot' : '' }}">
							<i class="material-icons">whatshot</i> {{ $blockFeatures[2]->click->click_count }}
						</span>
					@endif
					<div class="title"><a href="/articles/content/{{ $blockFeatures[2]->slug }}">{{ $blockFeatures[2]->title }}</a></div>
				</div>
			</div>
      
		</div>
	</div>
</div>

<style>
	@foreach( $blockFeatures AS $blockFeature )
		{!! $blockFeature->css_blocks !!}
	@endforeach
</style>

<?php
	$blockFeatures = \App\Article::with( 'category', 'click' )
		->where( 'articles.company_id', $id )
		->feature()
		->orderBy( 'id', 'DESC' )
		->take(5)
		->get();
?>

<div class="article-feature-wrapper">
	<?php $iteration = 0; ?>
	@foreach( $blockFeatures AS $blockFeature )
		<div class="feature feature-{{ $iteration > 1 ? 'tiny' : 'small' }}">
			<a href="/articles/content/{{ $blockFeatures[$iteration]->slug }}">
			<div class="image-wrapper">
				<div class="image-overlay"></div>
				<div class="image-crop">
						<img src="/data/articles/img/{{ $blockFeatures[$iteration]->image }}" alt="{{ $blockFeatures[$iteration]->title }}">
					</div>
			</div>
			<div class="text-wrapper">
				<span class="taxonomy">
					<a href="/articles/category/{{ $blockFeatures[$iteration]->category['slug'] }}">{{ $blockFeatures[$iteration]->category['title'] }}</a>
				</span>
				@if ( isset( $blockFeatures[$iteration]->click->click_count ) && $blockFeatures[$iteration]->click->click_count > 5 )
					<span class="shares{{ $blockFeatures[$iteration]->click->click_count > 10 ? ' hot' : '' }}">
						<i class="material-icons">whatshot</i> {{ $blockFeatures[$iteration]->click->click_count }}
					</span>
				@endif
				<div class="title"><a href="/articles/content/{{ $blockFeatures[$iteration]->slug }}">{{ $blockFeatures[$iteration]->title }}</a></div>
			</div>
			</a>
		</div>
		<?php $iteration++; ?>
	@endforeach
</div>

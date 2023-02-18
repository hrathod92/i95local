<?php
	$blockSide = App\Helpers\AdSelect::get( 5 );
?>
@if(count($blockSide) > 0)
	<div class="half-page-banners right-column-banners">
		<div class='{{ $blockSide->class }} ad'>
			<a href='{{ $blockSide->ad_url }}' alt='{{ $blockSide->image_alt }}' data-ad-id="{{ $blockSide->id }}" class="ad-click-tracking" target="_blank"><img src='/data/ads/img/{!! $blockSide->image !!}' alt="{{ $blockSide->image_alt }}" /></a>
		</div>
	</div>
@endif

<?php
	$blockSideB = App\Helpers\AdSelect::get( 6 );
?>
@if(count($blockSideB) > 0)
	<div class="medium-rectangle-banners right-column-banners">
		<div class='{{ $blockSideB->class }} ad'>
			<a href='{{ $blockSideB->ad_url }}' alt='{{ $blockSideB->image_alt }}' data-ad-id="{{ $blockSideB->id }}" class="ad-click-tracking" target="_blank"><img src='/data/ads/img/{!! $blockSideB->image !!}'  alt="{{ $blockSideB->image_alt }}"/></a>
		</div>
	</div>
@endif
<?php
	$blockSideC = App\Helpers\AdSelect::get( 7 );
?>
@if(count($blockSideC) > 0)
	<div class="medium-rectangle-banners right-column-banners">
		<div class='{{ $blockSideC->class }} ad'>
			<a href='{{ $blockSideC->ad_url }}' alt='{{ $blockSideC->image_alt }}' data-ad-id="{{ $blockSideC->id }}" class="ad-click-tracking" target="_blank"><img src='/data/ads/img/{!! $blockSideC->image !!}'  alt="{{ $blockSideC->image_alt }}"/></a>
		</div>
	</div>
@endif
<style>
	.half-page-banners.right-column-banners .ad {
		height: auto;
		background: transparent;
	}
</style>
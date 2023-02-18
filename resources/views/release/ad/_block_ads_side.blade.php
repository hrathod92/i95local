<?php
	$blockSide = App\Helpers\AdSelect::get( 65 );
?>
@if(!empty($blockSide))
<div class="half-page-banners right-column-banners">
	<div class='{{ $blockSide->class }} ad'>
		<a href='{{ $blockSide->ad_url }}' data-ad-id="{{ $blockSide->id }}" class="ad-click-tracking" target="_blank"><img src='/data/ads/img/{!! $blockSide->image !!}' /></a>
	</div>
</div>
@endif

<?php
	$blockSideB = App\Helpers\AdSelect::get( 66 );
?>
@if(!empty($blockSideB))
	<div class="medium-rectangle-banners right-column-banners">
		<div class='{{ $blockSideB->class }} ad'>
			<a href='{{ $blockSideB->ad_url }}' data-ad-id="{{ $blockSideB->id }}" class="ad-click-tracking" target="_blank"><img src='/data/ads/img/{!! $blockSideB->image !!}' /></a>
		</div>
	</div>
@endif

<?php
	$blockSideC = App\Helpers\AdSelect::get( 67 );
?>
@if(!empty($blockSideC))
	<div class="medium-rectangle-banners right-column-banners">
		<div class='{{ $blockSideC->class }} ad'>
			<a href='{{ $blockSideC->ad_url }}' data-ad-id="{{ $blockSideC->id }}" class="ad-click-tracking" target="_blank"><img src='/data/ads/img/{!! $blockSideC->image !!}' /></a>
		</div>
	</div>
@endif

<style>
	.half-page-banners.right-column-banners .ad {
		height: auto;
		background: transparent;
	}
</style>
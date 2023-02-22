<?php
	if ( !empty( $categoryID ) && $categoryID != 0 ) {
		$blockSide = App\Helpers\AdSelect::get( 35, $categoryID );
	}else{
		$blockSide = App\Helpers\AdSelect::get( 35 );
	}
	if(empty($blockSide)){
		$blockSide = App\Helpers\AdSelect::get( 35 );
	}
?>
@if(is_array($blockSide) && count($blockSide) > 0)
	<div class="half-page-banners right-column-banners">
		<div class='{{ $blockSide->class }} ad'>
			<a href='{{ $blockSide->ad_url }}' alt='{{ $blockSide->title }}' data-ad-id="{{ $blockSide->id }}" class="ad-click-tracking" target="_blank"><img src='/data/ads/img/{!! $blockSide->image !!}' alt="{{ $blockSide->image_alt }}" /></a>
		</div>
	</div>
@endif


<?php
	if ( !empty( $categoryID ) && $categoryID != 0 ) {
		$blockSideB = App\Helpers\AdSelect::get( 36, $categoryID );
	}else{
		$blockSideB = App\Helpers\AdSelect::get( 36 );
	}
	if(empty($blockSideB)){
		$blockSideB = App\Helpers\AdSelect::get( 36 );
	}
?>
@if(is_array($blockSideB) && count($blockSideB) > 0)
	<div class="medium-rectangle-banners right-column-banners">
		<div class='{{ $blockSideB->class }} ad'>
			<a href='{{ $blockSideB->ad_url }}' alt='{{ $blockSideB->title }}' data-ad-id="{{ $blockSideB->id }}" class="ad-click-tracking" target="_blank"><img src='/data/ads/img/{!! $blockSideB->image !!}'  alt="{{ $blockSideB->image_alt }}"/></a>
		</div>
	</div>
@endif

<?php
	if ( !empty( $categoryID ) && $categoryID != 0 ) {
		$blockSideC = App\Helpers\AdSelect::get( 37, $categoryID );
	}else{
		$blockSideC = App\Helpers\AdSelect::get( 37 );
	}
	if(empty($blockSideC)){
		$blockSideC = App\Helpers\AdSelect::get( 37 );
	}
?>
@if(is_array($blockSideC) && count($blockSideC) > 0)
	<div class="medium-rectangle-banners right-column-banners">
		<div class='{{ $blockSideC->class }} ad'>
			<a href='{{ $blockSideC->ad_url }}' alt='{{ $blockSideC->title }}' data-ad-id="{{ $blockSideC->id }}" class="ad-click-tracking" target="_blank"><img src='/data/ads/img/{!! $blockSideC->image !!}' alt="{{ $blockSideC->image_alt }}" /></a>
		</div>
	</div>
@endif
<style>
	.half-page-banners.right-column-banners .ad {
		height: auto;
		background: transparent;
	}
</style>

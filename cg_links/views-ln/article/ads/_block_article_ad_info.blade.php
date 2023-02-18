<?php
	if ( !empty( $categoryID ) && $categoryID != 0 ) {
		$blockInfo = App\Helpers\AdSelect::get( 31, $categoryID );
	}
	if ( empty( $blockInfo ) || $blockInfo->count() < 1 ) {
		$blockInfo = App\Helpers\AdSelect::get( 31 );
	}
?>

<div class='leaderboard-banner bottom'>
	@if(!empty($blockInfo))
		<div class='{{ $blockInfo->class }} ad' style="margin-bottom:25px;">
			<a href='{{ $blockInfo->ad_url }}' alt='{{ $blockInfo->title }}' data-ad-id="{{ $blockInfo->id }}" class="ad-click-tracking" target="_blank"><img src='/data/ads/img/{!! $blockInfo->image !!}'  alt="{{ $blockInfo->image_alt }}"/></a>
		</div>
	@endif
</div>

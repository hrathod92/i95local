<?php
	$blockInfo = App\Helpers\AdSelect::get( 11 );
?>
@if(!empty($blockInfo))
	<div class='leaderboard-banner bottom'>
		<div class='{{ $blockInfo->class }} ad'>
			<a href="{{ $blockInfo->ad_url }}" alt='{{ $blockInfo->title }}' data-ad-id="{{ $blockInfo->id }}" class="ad-click-tracking" target="_blank"><img src='/data/ads/img/{!! $blockInfo->image !!}' alt="{{ !empty($blockInfo->image_alt) ? $blockInfo->image_alt:$blockInfo->title }}" /></a>
		</div>
	</div>
@endif
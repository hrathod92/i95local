<?php
$blockInfo = App\Helpers\AdSelect::get( 71 );
?>

@if(count($blockInfo) > 0)
	<div class='leaderboard-banner bottom'>
		<div class="{{ !empty($blockInfo->class) ? $blockInfo->class : null }} ad" style="margin-bottom:25px;">
			<a href='{{ $blockInfo->ad_url }}' alt='{{ $blockInfo->title }}' data-ad-id="{{ $blockInfo->id }}" class="ad-click-tracking" target="_blank"><img src='/data/ads/img/{!! $blockInfo->image !!}' alt="{{ $blockInfo->image_alt }}"/></a>
		</div>
	</div>
@endif

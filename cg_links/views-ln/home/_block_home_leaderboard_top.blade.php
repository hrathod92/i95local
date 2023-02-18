<?php
	$blockInfo = App\Helpers\AdSelect::get( 10 );
?>
@if(!empty($blockInfo))
	<div class='leaderboard-banner top'>
			<div class='{{ $blockInfo->class }} ad' style="margin-bottom:25px;">
				<a href="{{ $blockInfo->ad_url }}" alt='{{ $blockInfo->title }}' data-ad-id="{{ $blockInfo->id }}" class="ad-click-tracking" target="_blank"><img src='/data/ads/img/{!! $blockInfo->image !!}'  alt='{{ !empty($blockInfo->image_alt) ? $blockInfo->image_alt : $blockInfo->title }}' /></a>
			</div>
	</div>
@endif
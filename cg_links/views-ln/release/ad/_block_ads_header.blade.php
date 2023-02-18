<?php
	$blockInfo = App\Helpers\AdSelect::get( 60 );
?>
@if(!empty($blockInfo))
	<div class='leaderboard-banner top'>
		<div class='{{ $blockInfo->class }} ad'>
			<a href='{{ $blockInfo->ad_url }}' data-ad-id="{{ $blockInfo->id }}" class="ad-click-tracking" target="_blank"><img src='/data/ads/img/{!! $blockInfo->image !!}' /></a>
		</div>
	</div>
@endif

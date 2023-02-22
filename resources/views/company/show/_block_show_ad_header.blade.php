<?php
	$t = \Carbon\Carbon::now();
	$blockInfo = \App\Ad::where('company_id', $id)->where('ad_type_id', 20)->where('status_id', 0)->where('publish_end_at', '>=', $t)->first();
	if(is_array($blockInfo) && count($blockInfo) == 0){
		$blockInfo = \App\Ad::where('company_id', $id)->where('ad_type_id', 40)->where('status_id', 0)->where('publish_end_at', '>=', $t)->first();
	}
?>
@if(!empty($blockInfo))
	<div class='leaderboard-banner top'>
		@if($id == $blockInfo->company_id)
			<div class='{{ $blockInfo->class }} ad'>
				<a href='{{ $blockInfo->ad_url }}' alt='{{ $blockInfo->title }}' data-ad-id="{{ $blockInfo->id }}" class="ad-click-tracking" target="_blank"><img src='/data/ads/img/{!! $blockInfo->image !!}' /></a>
			</div>
		@endif
	</div>
@endif

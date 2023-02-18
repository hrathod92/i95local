<?php 
	$blockSubscribe = \App\Block::where( 'slug', 'subscribe' )->first();
	$blockAd = \App\Helpers\AdSelect::get( 2 );
?>

<div id="superfooter" class='clearfix'>
  <div id="superfooter-inner">
	<div class="block join-mailing-list">
		  {!! isset( $blockSubscribe->body ) ? $blockSubscribe->body : '' !!}
	  </div>
		
	  <div class="block i95-block">
			@if ( isset( $blockAd[0] ))
				<a href='{{ $blockAd[0]->ad_url }}' data-ad-id="{{ $blockAd[0]->id }}" class="ad-click-tracking" target="_blank">
					<img src='/data/ads/img/{{ $blockAd[0]->image }}' />
				</a>
			@endif 
		</div>
  </div>
</div>

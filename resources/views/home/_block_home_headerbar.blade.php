<?php
$blockInfos = App\Services\AdRandomizer::getRandomByType('home-header');
?>
<div class='ad-home-headers'>
	@foreach ( $blockInfos AS $blockInfo )
		<div class='{{ $blockInfo->class }}'>
			{!! $blockInfo->body !!}
		</div>
	@endforeach	
</div>
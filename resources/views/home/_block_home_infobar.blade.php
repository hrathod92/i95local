@php
//$blockInfos = App\Services\AdRandomizer::getRandomByType('home-info');
	$blockInfos = App\Release::where( 'status_id', 0 )->orderBy( 'id', 'desc' )->take(3)->get();
@endphp

<div class='ad-home-infos'>
	@foreach ( $blockInfos AS $blockInfo )
		<div class='{{ $blockInfo->class }}'>
			{!! $blockInfo->body !!}
		</div>
	@endforeach	
</div>

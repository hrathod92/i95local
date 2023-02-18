<?php 
	$videos = \App\Video::where( 'company_id', $id )
		->where( 'status_id', 0 )
		->orderBy( 'id', 'DESC' )
		->take(6)
		->get();
	
	$overflow = \App\Video::where( 'company_id', $id )
		->where( 'status_id', 0 )
		->orderBy( 'id', 'DESC' )
		->skip(6)
		->take(40)
		->get();
?>

<style>
	.button-overflow-container {
		margin: 2em 0 .625em;
		text-align: center;
	}
	#button-overflow {
		float: none;
		text-transform: none;
	}
	.overflow-wrapper #overflow {
		margin: 1.5em 0 0;
	}
</style>

<div class="contributor-videos">
	<h2>Videos</h2>
	<div class="videos">
		@foreach ( $videos AS $video )
			<div class="video">
				<div class="video-wrapper media-embed">
					{!! $video->embed !!}
				</div>
				<div class="text-wrapper">
					<span class="date">Published on {!! date( 'M d, Y', strtotime( $video->created_at )) !!}</span>
					<div class="title"><a href="#">{!! $video->title !!}</a></div>
				</div>
			</div>
		@endforeach
	</div>
	@if(count($overflow) > 0)
	<div class="button-overflow-container clearfix">
		<button onclick="myFunction('overflow')" id="button-overflow" class="">View More Videos</button>
	</div>
	<div class="client-details overflow-wrapper clearfix">
		<div id="overflow" style="display:none;">
			<div class="videos">
				@foreach ( $overflow AS $video )
					<div class="video">
						<div class="video-wrapper media-embed">
							{!! $video->embed !!}
						</div>
						<div class="text-wrapper">
							<span class="date">Published on {!! date( 'M d, Y', strtotime( $video->created_at )) !!}</span>
							<div class="title"><a href="#">{!! $video->title !!}</a></div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>
	@endif
</div>
<script>
  function myFunction(id) {
    if($('#button-overflow').hasClass('open')){
			$('#overflow').hide();
			$('#button-overflow').removeClass('open');
		}
		else{
			$('#overflow').show();
			$('#button-overflow').addClass('open');
		}
		
		var button = document.getElementById('button-overflow');
		if (button.innerHTML === "View More Videos") {
        button.innerHTML = "View Less Videos";
    }
    else {
        button.innerHTML = "View More Videos";
    }
	}    
</script>
<div class='videos-wrapper'>
	
	<?php 
		$videoFavs = \App\Video::where( 'status_id', 0 )
			->where( 'favorite_id', '>', 0 )
			->orderBy( 'favorite_id' )
			->orderBy( 'id', 'desc' )
			->take(3)
			->get();
		if ( $videoFavs->count() < 3 ) {
			$videoFavs = $videoFavs->merge( 
				\App\Video::where( 'status_id', 0 )
					->where( 'favorite_id', 0 )
					->orderBy( 'id', 'DESC' )
					->take( 3-$videoFavs->count() )
					->get() 
			);
		}
		$videoFav = $videoFavs->shift();	
	?>
	
	<h2>Videos</h2>
	@if( $videoFav )
		<div class="top-video">
	
			<div class="video-embed">
				<div class="fav-video-thumb"><a href="{{route('videos.show', $videoFav)}}" alt="Go to Video"><img src="https://img.youtube.com/vi/<?php echo $videoFav->youtube_video_id ?>/hqdefault.jpg" /></a></div>				
				<div class="text-wrapper">
					<span class="date">Published on {!! date( 'M d, Y', strtotime( $videoFav->created_at )) !!}</span>
					<div class="title"><a href="{{route('videos.show', $videoFav)}}">{!! $videoFav->title !!}</a></div>
				</div>
				<div class="subscribe-wrapper"><a href="https://www.youtube.com/user/I95Biz" target="_blank">Subscribe on YouTube</a></div>
			</div>
			
<!--			<div class="video">
				<div class="video-wrapper media-embed">
					{!! $videoFav->embed !!}
				</div>
				<div class="text-wrapper">
					<span class="date">Published on {!! date( 'M d, Y', strtotime( $videoFav->created_at )) !!}</span>
					<div class="title"><a href="{{route('videos.show', $videoFav)}}">{!! $videoFav->title !!}</a></div>
				</div>
				<div class="subscribe-wrapper"><a href="#">Subscribe on YouTube</a></div>
			</div> -->
		</div>

	@endif

	<div class="more-videos">
		@if($videoFavs->count())
			@foreach ( $videoFavs AS $videoFav )

				<div class="video-embed">
					<div class="more-video-thumb"><a href="{{route('videos.show', $videoFav)}}" alt="Go to Video"><img src="https://img.youtube.com/vi/<?php echo $videoFav->youtube_video_id ?>/hqdefault.jpg" /></a></div>				
					<div class="text-wrapper">
						<span class="date">Published on {!! date( 'M d, Y', strtotime( $videoFav->created_at )) !!}</span>
						<div class="title"><a href="{{route('videos.show', $videoFav)}}">{!! $videoFav->title !!}</a></div>
			  	</div>
				</div>

		<!--			<div class="video">
				<div class="video-wrapper">
					<div class="media-embed">
						{!! $videoFav->embed !!}
					</div>
				</div>
				<div class="text-wrapper">
					<span class="date">Published on {!! date( 'M d, Y', strtotime( $videoFav->created_at )) !!}</span>
					<div class="title"><a href="{{route('videos.show', $videoFav)}}">{!! $videoFav->title !!}</a></div>
				</div>
			</div> -->
			@endforeach
		@endif
	</div>
	
	<?php 
	$blockNewsletter = \App\Newsletter::where( 'status_id', 0 )
		->orderBy( 'title', 'DESC' )
		->first(); ?>
	
	<div class="newsletter-wrapper">
		<div class='newsletter'>
			<a href="/newsletters/current">
				<div class='newsletter-image'><img src="/data/newsletters/img/{{ $blockNewsletter->image }}" alt="I95 Newsletter | Issue: {{ $blockNewsletter->title }}" /></div>
				<div class="text-wrapper">
					<div class='date'>PUBLISHED IN {{ date( 'M-Y', strtotime( $blockNewsletter->title )) }}</div>
					<div class='title'>Current Newsletter</div>
				</div>
			</a>
		</div>
	</div>
	
</div>
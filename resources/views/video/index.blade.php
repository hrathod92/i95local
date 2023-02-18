<?php $page['title'] = 'Videos'; ?>
<?php $page['sideblocks'] = [ 'video.ad._block_ads_side' ]; ?>
<?php $page['css'] = 'videos'; ?>

@extends( 'templates.default' )
@section('head')
	<meta property="og:url"           content="{{ Request::fullUrl() }}" />
  	<meta property="og:type"          content="website" />
  	<meta property="og:title"         content="{{ !empty($type) ? $type.' | ' : null }}Videos | I95 Business" />
  	<meta property="og:description"   content="{{ !empty($type) ? $type.' | ' : null }}Videos | I95 Business" />
<title>{{ !empty($type) ? $type.' | ' : null }}Videos | I95 Business</title>
@endsection
@section( 'content' )

@include( 'video.ad._block_ads_header' )

@include( 'video._block_index_filter' )

<div class='view-videos'>
	@if ( $items->count() )
		@foreach ( $items as $item )
			<div class="video">
				<div class="video-embed">
					<div class="video-crop">
						<a href="/videos/show/<?php echo $item->id ?>" alt="Go to Video">
							<img src="https://img.youtube.com/vi/<?php echo $item->youtube_video_id ?>/hqdefault.jpg" />
						</a>
					</div>				
				</div>
				<div class="text-wrapper">
					<div class="title">{{ $item->title }}</div>
					<div class="video-type"><span>Type:</span> {{ $item->video_type['title'] }}</div>
				</div>
			</div>
		@endforeach
  @else
		<div class="video-empty" data-label="Empty">No videos found.  Please select another category or search term.</div>
	@endif
</div>

@include( 'video.ad._block_ads_info' )

<script type="text/javascript">
	$(document).ready(function() {
		$('#video-filter-btn').click(function(event) {
  		$('#video_filters').submit();
    });
	});
</script>

@stop
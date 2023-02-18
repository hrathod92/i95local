<?php 
    $page['title'] = 'Events';
    $page['sideblocks'] = array( 'event._block_index_sidebar', 'event.ad._block_ads_side' );
?>

@extends( 'templates.default' )
@section('head')
	<meta property="og:url"           content="{{ Request::fullUrl() }}" />
  	<meta property="og:type"          content="website" />
  	<meta property="og:title"         content="{{ !empty($type) ? $type.' | ':null }}Events | I95 Business" />
  	<meta property="og:description"   content="{{ !empty($type) ? $type.' | ':null }}Events | I95 Business" />
<title>{{ !empty($type) ? $type.' | ':null }}Events | I95 Business</title>
@endsection
@section( 'content' )

@include( 'event.ad._block_ads_header' )

@include( 'event._block_index_filter' )

<div class='events'>
	@if ( $items->count() )
    @foreach ( $items as $item )
		 <?php
			 if(!empty($item->slug)){
				 $url = '/events/show/'.$item->slug;
			 }else{
				 $url = '/events/'.$item->id;
			 }
			?>
			<div class='event'>
        <div class="event-title">
					<a href='{{ $url }}'>{{ $item->title }}</a>
				</div>
        <div class="event-location">
					{{ $item->location }}
				</div>
        <div class="event-date nowrap">
					{{ \Carbon\Carbon::parse($item->starts_at)->format('M d, Y') }}
      	</div>
			</div>
		@endforeach
  @else
		<div class="event-empty" data-label="Empty">No events found.  Please select another category or search term.</div>
	@endif
</div>


@include( 'event.ad._block_ads_info' )

@stop
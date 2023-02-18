@if ( \Auth::check() && ( \Auth::user()->role == 'admin' || \Auth::user()->company_id == $id ))
	<ul class='actions'>
		<li><a class='button' href='/companies/{{ $id }}/edit'>Edit Company</a></li>
		<li><a class='button' href='/authors/company/{{ $id }}'>Edit Authors</a></li>
	</ul>
@endif

<style>
	#sidebar #sidebar-inner .actions {
		padding: 0;
	}
	#sidebar #sidebar-inner .actions li {
		list-style: none;
	}
	#sidebar #sidebar-inner .actions li a.button {
		width: 100%;
	}
</style>

@include( 'company.show._block_show_categories' )

<?php
	$blockSides = \App\Ad::where( 'status_id', 0 )->where('ad_type_id', 25)->where('company_id', $id)->where('publish_end_at', '>=', \Carbon\Carbon::now())->get();
?>
<div class="half-page-banners right-column-banners">
	@foreach ( $blockSides AS $blockSide )
	  <div class='{{ $blockSide->class }} ad'>
			<a href='{{ $blockSide->ad_url }}' data-ad-id="{{ $blockSide->id }}" class="ad-click-tracking" target="_blank"><img src='/data/ads/img/{!! $blockSide->image !!}' alt="{{$blockSide->image_alt}}" /></a>
		</div>
	@endforeach
</div>


@include( 'company.show._block_show_authors' )

<?php
	$blockSides = \App\Ad::where( 'status_id', 0 )->where('ad_type_id', 26)->where('company_id', $id)->where('publish_end_at', '>=', \Carbon\Carbon::now())->get();

?>
<div class="medium-rectangle-banners right-column-banners">
	@foreach ( $blockSides AS $blockSide )
		<div class='{{ $blockSide->class }} ad'>
			<a href='{{ $blockSide->ad_url }}' alt='{{ $blockSide->title }}' data-ad-id="{{ $blockSide->id }}" class="ad-click-tracking" target="_blank"><img src='/data/ads/img/{!! $blockSide->image !!}' alt="{{ $blockSide->image_alt }}" /></a>
		</div>
	@endforeach
</div>

@if ( !empty( $body ))
  <div class="block bottom-line contributor-info">
    <h2>About Us</h2>
    <div class="content-wrapper">
      <p>{{ $body }} <a href="#">Read more</a></p>
    </div>
  </div>
@endif

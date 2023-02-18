<?php 
  use \App\Helpers\Display;
  $page['title'] = 'Contributors';
  $page['sideblocks'] = array( 'ad._block_ads_side' );
  $page['css'] = 'company-index'; 
?>

@extends( 'templates.default' )
@section('head')
	<meta property="og:url"           content="{{ Request::fullUrl() }}" />
  	<meta property="og:type"          content="website" />
  	<meta property="og:title"         content="Contributors | I95 Business" />
  	<meta property="og:description"   content="Contributors | I95 Business" />
  	<meta property="og:image"         content="{{ !empty($companies[0]->image) ? url('/').'/data/companies/img/'.$companies[0]->image : null }}" />
<title>Contributors | I95 Business</title>
@endsection
@section( 'content' )

@include( 'ad._block_ads_header' )

@include( 'company._block_index_filter' )

<div class='companies'>
  @if ( $companies->count() )
    @foreach ( $companies AS $company )
      <div class="company">
        <a class="company-details" href="/companies/{{ $company->slug }}">
			@if ( !empty( $company->image ))
				<img class='company-image' src="/data/companies/img/{{ $company->image }}?ut={{ str_replace( ' ', '-', $company->updated_at ) }}" />
			@else
				<div class="company-title">{{ $company->title }}</div>
			@endif
		</a>
      </div>
    @endforeach
  @else
		<div class="company-empty" data-label="Empty">No companies found.  Please select another category or search term.</div>
	@endif
</div>

@include( 'ad._block_ads_info' )

@stop

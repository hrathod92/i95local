<?php 
	$page['title'] = 'Jobs';
  	$page['sideblocks'] = array( 'job._block_index_sidebar', 'job.ad._block_ads_side' );
	$page['css'] = 'job-index';
?>

@extends( 'templates.default' )
@section('head')
	<meta property="og:url"           content="{{ Request::fullUrl() }}" />
  	<meta property="og:type"          content="website" />
  	<meta property="og:title"         content="{{ !empty($type) ? $type.' | ': null }}Jobs | I95 Business" />
  	<meta property="og:description"   content="{{ !empty($type) ? $type.' | ': null }}Jobs | I95 Business" />
<title>{{ !empty($type) ? $type.' | ': null }}Jobs | I95 Business</title>
@endsection
@section( 'content' )

@include( 'job.ad._block_ads_header' )

@include( 'job._block_index_filter' )

@if(!empty($jobTypeTitle))
	<h2>Type: {{$jobTypeTitle}}</h2>
@endif

<div class='jobs'>
	@if(count($items) > 0)
		@foreach ($items as $item)
			<div class="job">
				<div class='job-company'>
					<a target='_blank' href="/companies/{{ $item->company_id }}">{{ $item->company['title'] }}</a>
				</div>
				<div class="job-title">
					<a href="{{route('jobs.show', $item)}}">{{ $item->job_title }}</a>
				</div>
				<div class='job-type'>
					@if( $item->job_type ) 
						{{ $item->job_type->title }} 
					@endif
				</div>
				<div class='job-created-at no-wrap'>
					{{ date( 'M d, Y', strtotime( $item->created_at )) }}
				</div>
			</div>
		@endforeach
	@else
		<div class='job-empty'>No Jobs found. Please select another category or search term.</div>
	@endif
</div>

<style>
	.jobs .job {
		margin-bottom: 0.625em;
		padding-bottom: 0.625em;
	}
	.jobs .job .job-company {
		width: 10em;
	}
	.jobs .job .job-title {
		font-size: 1em;
	}
</style>

@include( 'job.ad._block_ads_info' )

@stop

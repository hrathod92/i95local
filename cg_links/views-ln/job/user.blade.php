<?php 
	$page['title'] = 'Jobs';
  $page['sideblocks'] = array( 'job.ad._block_ads_side' );
	$page['css'] = 'job-index';
?>

<?php 
	// $page['sideblocks'][] = 'job-type._block_sidebar'; 
?>

@extends( 'templates.default' )
@section( 'content' )

@include( 'job.ad._block_ads_header' )

@include( 'job._block_index_filter' )

@if(!empty($jobTypeTitle))
    <h2>Type: {{$jobTypeTitle}}</h2>
@endif
<div class='jobs'>
    @forelse ($items as $item)
        <div class="job">
            <div class="job-title">
                <a href="{{route('jobs.show', $item)}}">
                    {{$item->job_title}}
                </a>
            </div>
            <div class='job-company'>
                <a target='_blank' href="{{$item->company_url}}">
                    {{ $item->company['title'] }}
                </a>
            </div>
            <div class='job-type'>
                @if($item->job_type)
                    {{$item->job_type->title}}
                @endif
            </div>

            <div class='job-created-at no-wrap'>
	            {{ date( 'M d, Y', strtotime( $item->created_at )) }}
	          </div>
        </div>
    @empty
        <div class='job-empty'>No Jobs found.  Please select another category or search term.</div>
    @endforelse
</div>

<style>
	.job {
		margin-bottom: 0.5em !important;
		padding-bottom: 0.5em !important;
	}
	.job > div {
		display: inline-block;
		padding: 0 1em;
		margin: 0;
		text-align: center;
		font-size: 1em !important;
		font-weight: normal !important;
	}
	.job-title {
		width: 37%;
		text-align: left !important;
	}
	.job-company {
		width: 25%;
	}
	.job-type {
		width: 20%;
    text-transform: uppercase;
		text-align: right !important;
	}
	.job-created-at {
		width: 15%;
    text-transform: uppercase;
		text-align: right !important;
	}
	.job-empty {
		border: 1px solid #666;
    padding: 1em 2em;
    text-align: center;
    background: #ddd;
		width: 100%;
	}
</style>

@include( 'job.ad._block_ads_info' )

@stop

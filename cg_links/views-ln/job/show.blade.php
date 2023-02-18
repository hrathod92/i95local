<?php 
  $page['title'] = 'Job'; 
  $page['sideblocks'] = array( 'job.ad._block_ads_side' );
  $page['css'] = 'jobs'; 
?>

@extends( 'templates.default' )
@section('head')
	<meta property="og:url"           content="{{ Request::fullUrl() }}" />
  	<meta property="og:type"          content="website" />
  	<meta property="og:title"         content="{{ $item->job_title}}{{!empty($item->job_type->title) ? ' | '.$item->job_type->title.' | ' : null }}Jobs | I95 Business" />
  	<meta property="og:description"   content="{{ $item->job_title}}{{!empty($item->job_type->title) ? ' | '.$item->job_type->title.' | ' : null }}Jobs | I95 Business" />
<title>{{ $item->job_title}}{{!empty($item->job_type->title) ? ' | '.$item->job_type->title.' | ' : null }}Jobs | I95 Business</title>
@endsection
@section( 'content' )

@include( 'job.ad._block_ads_header' )

<div class="job">
 
  <div class='detail job-title'>
    <span class="label">Job Title:</span>
    <span>{!! $item->job_title !!}</span>
  </div>

  <div class='detail job-type'>
    <span class="label">Type:</span>
    @if( $item->job_type )
      <span>{!! $item->job_type->title !!}</span>
    @endif
  </div>

  <div class='detail job-company'>
      <span class="label">Company:</span>
      <span><a target='_blank' href="/companies/{{ $item->company_id }}">{{ $item->company['title'] }}</a></span>
  </div>
  
  <div class='detail job-description'>
    <span class="label">Description:</span>
    <span>{!! $item->description !!}</span>
  </div>

  <div class='detail job-location'>
    <span class="label">Location:</span>
    <span>{!! $item->location !!}</span>
  </div>

  <div class='detail job-contact-info'>
    <span class="label">Contact Info:</span>
    <span>{!! $item->contact_info !!}</span>
  </div>
  
  <div class='detail job-website'>
    <span class="label">Website:</span>
    <span>
      <?php $url = strpos( $item->company_url, 'http' ) !== false ? '' : 'http://' . $item->company_url; ?>
      <a href="{!! $url !!}">{!! $item->company_url !!}</a>
    </span>
  </div>
 
  <div class='detail job-created-at'><span class="label">Posted:</span><span>{!! date( 'M d, Y', strtotime( $item->created_at )) !!}</span></div>

  @if ( \Auth::check() && Auth::user()->role == 'admin' )
    <div class='detail job-status'>
      <span class="label">Status:</span>
      <span>{!! $item->status['title'] !!}</span>
    </div>
    <br />
    <div class='job-edit'><a class='button small' href='/jobs/{{ $item->id }}/edit'>Edit</a></div>
  @endif
</div>

@include( 'job.ad._block_ads_info' )

<style>
  .job .detail span.label {
    text-align: left;
  }
  .job .detail.job-description {
    margin-bottom: 0.625em;
  }

</style>

@stop
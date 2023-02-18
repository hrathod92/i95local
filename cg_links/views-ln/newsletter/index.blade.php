<?php $page['title'] = 'Magazine Archive'; ?>
<?php $page['sideblocks'] = [ 'ad._block_ads_side' ]; ?>
<?php $page['css'] = 'newsletter-index'; ?>

@extends( 'templates.default' )
@section('head')
	<meta property="og:url"           content="{{ Request::fullUrl() }}" />
  	<meta property="og:type"          content="website" />
  	<meta property="og:title"         content="Magazine Archive I95 Business" />
  	<meta property="og:description"   content="Magazine Archive I95 Business" />
  	<meta property="og:image"         content="{{ !empty($items[0]->image) ? url('/').'/data/newsletters/img/'.$items[0]->image : null }}" />
<title>Magazine Archive I95 Business  | I95 Business</title>
@endsection
@section( 'content' )

@include( 'ad._block_ads_header' )

@include( 'newsletter._block_index_filter' )

<div class='newsletters'>
  @foreach ( $items AS $item )
    <div class="newsletter">
      <div class="newsletter-image"><a href='/newsletters/{{ $item->id }}'><img src='/data/newsletters/img/{{ $item->image }}' alt="I95 Business Issue {{ $item->title }}" /></a></div>
      <div class="newsletter-title"><a href='/newsletters/{{ $item->id }}'>{{ date( 'F Y', strtotime( $item->title )) }}</a></div>
      <div class='newsletter-download'>
        <a class='' href='/data/newsletters/document/{{ $item->document }}' target='_blank'><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Download</a>
      </div>
    </div>
  @endforeach
</div>

@include( 'ad._block_ads_info' )

@stop

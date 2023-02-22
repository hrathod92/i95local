<?php $page['title'] = !empty($title) ? date( 'F Y', strtotime( $title )) . ' Magazine' : null; ?>
<?php $page['sideblocks'] = [ 'ad._block_ads_side' ]; ?>
<?php $page['css'] = 'newsletter-show'; ?>

@extends( 'templates.default' )
@section('head')
	<meta property="og:url"           content="{{ Request::fullUrl() }}" />
  	<meta property="og:type"          content="website" />
  	<meta property="og:title"         content="{{ !empty($title) ? date( 'F Y', strtotime( $title )) . ' Magazine : ' : null }}I95 Business" />
  	<meta property="og:description"   content="{{ !empty($title) ? date( 'F Y', strtotime( $title )) . ' Magazine' : null }}" />
  	<meta property="og:image"         content="{{ !empty($image) ? url('/').'/data/newsletters/img/'.$image : null }}" />
<title>{{ !empty($title) ? date( 'F Y', strtotime( $title )) . ' Magazine | ' : null }}I95 Business</title>
@endsection
@section( 'content' )

@include( 'ad._block_ads_header' )

@include( 'newsletter._block_show_articles' )

<div class="newsletter">

  @if ( isset( $image ) && strlen( $image ) > 0 )
    <div class="newsletter-image">
      <a href='/data/newsletters/document/{{ isset( $document ) ? $document : '' }}' target='_blank'>
        <img src="/data/newsletters/img/{{ $image }}?ut={{ str_replace( ' ', '-', $updated_at ) }}" alt="I95 Businnes Issue: {{ $title }}">
      </a>
    </div>
  @endif
  
  <div class='newsletter-read'>
    <a class='button' href='/data/newsletters/document/{{ isset( $document ) ? $document : '' }}' target='_blank'>Read Document</a>
  </div>

</div>

@include( 'ad._block_ads_info' )

@if ( Auth::check() && Auth::user()->role == 'admin' )
    <p><a href='/newsletters/{{ $id }}/edit'>edit</a></p>
@endif

<style>
  .newsletter {
    text-align: left;
    width: 60%;
  }
  .newsletter-image img {
    width: 100%;
  }
  .newsletter-read {
    text-align: center;
  }
  .newsletter-articles-wrapper {
    float: right;
    width: 35%;
    margin: 0 0 0 1%;
    padding; 1em;
  }
  .newsletter-articles {
    padding: 0;
    margin: 0;
  }
  .newsletter-article {
    list-style: none;
  }
</style>

@stop
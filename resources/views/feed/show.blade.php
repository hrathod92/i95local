<?php 
  $page['title'] = 'Feed (RSS) - ' . $title;
  $page['sideblocks'] = array( 'ad._block_ads_side' );
  $page['css'] = 'dashboard'; 
?>

@extends( 'templates.default' )
@section('head')
	<meta property="og:url"           content="{{ Request::fullUrl() }}" />
  	<meta property="og:type"          content="website" />
  	<meta property="og:title"         content="{{ $title}} | RSS Feed | I95 Business" />
  	<meta property="og:description"   content="{{ $title}} | RSS Feed | I95 Business" />
<title>{{ $title}} | RSS Feed | I95 Business</title>
@endsection
@section( 'content' )

@include( 'ad._block_ads_header' )

<div class='feeds'>
    <?php 
      $content = file_get_contents( $embed );
      $xml = new SimpleXmlElement( $content ); 
    ?>
    <ul>
      @foreach ( $xml->channel->item as $entry)
        <li><a class='link' href='{{ $entry->link }}'>{{ $entry->title }}</a></li>
      @endforeach
    </ul> 
</div>

@include( 'ad._block_ads_info' )

@if ( Auth::check() && Auth::user()->role == 'admin' )
    <div class="actions bottom"><a class="button small" href='/feeds/{{ $id }}/edit'>Edit</a></div>
@endif

<script>
  $(document).ready(function(){
    $('.link').attr( 'target', '_blank' );
  });
</script>

@stop

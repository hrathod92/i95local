<?php
  	//$page['title'] = $title;
  	$page['sideblocks'] = [ 'article.ads._block_article_ad_side' ];
  	$page['css'] = 'articles';

	$array = explode('.',$body);
	$description = strip_tags($array[0].'.');
?>

<?php use App\Setting; ?>

@extends( 'templates.default' )
@section('head')
	<meta property="og:url"           	content="{{ Request::fullUrl() }}" /></meta>
  	<meta property="og:type"          	content="website" /></meta>
  	<meta property="og:title"         	content="{{ !empty($title) ? $title.' : ' : null }}I95 Business" /></meta>
  	<meta property="og:description"   	content="{{ !empty($meta_description) ? $meta_description : $description }}" /></meta>
  	<meta property="og:image"         	content="{{ !empty($image) ? url('/').'/data/articles/img/'.$image : null }}" /></meta>
	<meta name="twitter:card" 			content="summary_large_image"></meta>
	<meta name="twitter:site" 			content="@I95Business"></meta>
	<meta name="twitter:image" 			content="{{ !empty($image) ? url('/').'/data/articles/img/'.$image : null }}"></meta>
	<meta name="twitter:image:alt" 		content="{{ !empty($title) ? $title.' : ' : null }}I95Business"></meta>
<title>{{ !empty($title) ? $title.' | ' : null }}I95 Business</title>
@endsection
@section( 'content' )


@include( 'article.ads._block_article_ad_header' )
@section( 'article_id', $data->id ) 

<script>window.twttr = (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0],
    t = window.twttr || {};
  if (d.getElementById(id)) return t;
  js = d.createElement(s);
  js.id = id;
  js.src = "https://platform.twitter.com/widgets.js";
  fjs.parentNode.insertBefore(js, fjs);

  t._e = [];
  t.ready = function(f) {
    t._e.push(f);
  };

  return t;
}(document, "script", "twitter-wjs"));</script>



<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.12&appId=1562103857345010&autoLogAppEvents=1';
	fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
</script>
<div class="article">
  <div class='article-text'>
		
		@if ( !empty( $title ))
    	<h1 class='article-title'>{!! $title !!}</h1>
		@endif
		
		@if ( !empty( $tagline ))
    	<h3 class='article-tagline'>{!! $tagline !!}</h3>
		@endif

		@if ( !empty( $company['title'] ))
			<h3 class='article-company'>{!! $company['title'] !!}</h3>
		@endif
		
		@if ( !empty( $author['title'] ))
    	<h3 class='article-author'>By {!! $author['title'] !!}</h3>
		@endif
		
		@if ( !empty( $pub_date ))
    	<h3 class='article-author'>{!! date( 'M d, Y', strtotime( $pub_date )) !!}</h3>
		@endif
		
    	<h3 class='article-category'>{!! $data->getCatStrWithAnchors() !!}</h3>
		<div class="share-icons-wrapper">
	  		<div class="fb-share-button" data-href="{{ Request::fullUrl() }}" data-layout="button" data-size="large" data-mobile-iframe="false"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div>
			<div class="twitter-button">
        <a class="twitter-share-button" href="https://twitter.com/intent/tweet" data-size="large" data-text="{!! $title !!}" data-via="I95Business" target="_blank">
          <i class="fa fa-twitter" aria-hidden="true"></i> Share
        </a>
      </div>
			<div class="linkedin-button"><div class="button-wrap"><script src="//platform.linkedin.com/in.js" type="text/javascript"> lang: en_US</script><script type="IN/Share"></script></div></div>
		</div>
		<div class='article-body'>
			
			@if ( !empty( $image ))
				<?php $imageWidth = ( !empty( $image_width ) && $image_width > 0 ) ? 'width:' . $image_width . '%' : ''; ?>
				<div class='main-article-image' style='{{ !empty( $imageWidth ) ? $imageWidth : ""  }}'>
					@if ( !empty( $video_id ))
						<div class="video-embed">
							<div class=""><a href="#article-video" alt="Go to Video">
								<img src="https://img.youtube.com/vi/{{ $video_id }}/hqdefault.jpg" alt="{!! $title !!}"/>
						</a></div>				
						</div>
					@else
						<img src='/data/articles/img/{{ $image }}?ut={{ str_replace( ' ', '-', $updated_at ) }}' alt="{{ !empty($image_caption) ? $image_caption : $title }}">
						@if ( !empty( $image_caption ))
							<div class='image-caption'>{{ $image_caption }}</div>
						@endif
					@endif
				</div>
			@else
				@if ( !empty( $video_id ))
					<div class='main-article-image'>
						<div class="video-embed">
							<div class=""><a href="#article-video" alt="Go to Video"><img src="https://img.youtube.com/vi/{{$video_id}}/hqdefault.jpg" /></a></div>				
						</div>
					</div>
				@endif
			@endif
			
			@if ( !empty( $body ))
				{!! $body !!}
			@endif
  		
			@if ( !empty( $general_caption ))
				<div class='general-caption'>
					<div class='general-caption-title'>Captions</div>
					<div class='general-caption-text'>{!! nl2br( $general_caption ) !!}</div>
				</div>
			@endif

			@if ( !empty( $video ))
				<div id='article-video' class='article-video'>
					{!! $video !!}
				</div>
   		@endif
			<div class='article-buttons'>
				@if ( $company_id != 0 )
					<a class='button click-tracking' href='/companies/{{ $company['slug'] }}' data-click-type='article-read' target='_blank'>Read More</a>
				@endif
				@if ( !empty( $company['contact_us_url'] ))
					@if ( strpos( $company['contact_us_url'], 'http' ) !== false )
						<a class='button click-tracking' href='{{ $company['contact_us_url'] }}' data-click-type='article-contact' target='_blank'>Contact Us</a>
					@else
						<a class='button click-tracking' href='http://{{ $company['contact_us_url'] }}' data-click-type='article-contact' target='_blank'>Contact Us</a>
					@endif
				@endif
			</div>
			
		</div>
    
    @if ( Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'editor'))
			<div class='article-keywords'>Keywords: {{ !empty( $keywords ) ? $keywords : '' }}</div>
      <a class="btn small" href='/articles/{{ $id }}/edit'>Edit</a>
    @endif
	@if ( Auth::check() && (Auth::user()->role == 'agency' ))
		<div class='article-keywords'>Keywords: {{ !empty( $keywords ) ? $keywords : '' }}</div>
      	<a class="btn small" href='/dashboard'>Return to Dashboard</a>
    @endif
		
  </div>
</div>

@include( 'article.ads._block_article_ad_info' )

@include( 'article.show._block_show_related' )

<style>
	.article-body .main-article-image img {
		width: 100%;
	}
	.article-body p img[style*="float:left"] {
		margin: 0.5em 1em 0.5em 0 !important;
	}
	.article-body p img[style*="float:right"] {
		margin: 0.5em 0 0.5em 1em !important;
	}
  .article-feature-wrapper .feature .image-wrapper .image-crop img {
    max-height: 100%;
    height: auto;
  }
</style>

@stop

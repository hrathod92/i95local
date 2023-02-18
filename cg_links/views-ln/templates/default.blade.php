<?php 
	$page['controller'] = Request::segment(1);
	if(Route::getCurrentRoute() != null)
	{
		$page['action'] = substr( Route::getCurrentRoute()->getActionName(), strpos( Route::getCurrentRoute()->getActionName(), '@' ) + 1 );
	} else {
		$page['action'] = '';
	}
	$page['module'] = $page['controller'] . '-' . $page['action']; 
?>

<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
	@section('head')
	@show
	@include( 'templates.includes.head' )
</head>

<body data-item-id="@yield('article_id')">
@include( 'templates.includes.insightTracking' )
  
<a class="skip-main" href="#main">Skip to main content</a>
<div id="page" class="page-<?php echo ( isset( $page['module'] ) > 0 ?  $page['module'] : 'home' ); ?>">
	
  <header id="header" class="clearfix" role="banner">
  	<div id="header-inner" class="wrap">
	  	@include( 'templates.includes.utility' )
  		@include( "templates.includes.header" )
	  	<div class="nav-wrapper">
			<div id="mobile-header">
				<a id="responsive-menu-button" href="#sidr-main"><i class="material-icons">menu</i><span class="text">Menu</span></a>
			</div>
			<div id="navigation" class="clearfix">
				<div id="navigation-inner" class="wrap" role="navigation" aria-label="main navigation">
					@include( "templates.includes.menu" )
				</div>
			</div>
		</div>
  	</div>
  </header>
	
  @section('hero')
  @show
	
  <div id="main" class="clearfix" tabindex="-1" role="main">
    <div id="content-header">
      <div class="content-header-inner">
				
				@if ( isset( $page['breadcrumb'] ))
					<div id="breadcrumb">{!! $page['breadcrumb'] !!}</div>
				@endif

				@if ( isset( $page['title'] ) && strlen( $page['title'] ) > 0 )
					<h1 class="title">{{ $page['title'] }}</h1>
				@endif

				@if ( isset( $_SESSION['highlighted'] ))
					echo '<div id="highlighted">' . $_SESSION['highlighted'] . '</div>';
					unset($_SESSION['highlighted']);
				@endif

				@if ( isset( $_REQUEST['highlighted'] ))
					echo '<div id="highlighted">' . $_REQUEST['highlighted'] . '</div>';
				@endif

				@if ( isset($_SESSION['message'])) {
					echo '<div id="messages">' . $_SESSION['message'] . '</div>';
					unset($_SESSION['message']);
				@endif

				@if ( isset($_REQUEST['message'])) {
					echo '<div id="messages">' . $_REQUEST['message'] . '</div>';
				@endif
      </div>
		</div>
  	<div id="main-inner" class="wrap">
		@if ( isset($errors))
			@foreach($errors->all() as $message)
				<div style="color:red">{{$message}}</div>
			@endforeach
		@endif

    @if ( isset( $page['sideblocks'] ))
        <div id="content" class="sidebar clearfix">

					<!--@section( 'header-blocks' )
						<div class='header-blocks'>
						</div>
					@show-->
					
          <div id="content-area" class='clearfix'>
          @section( 'content' )
          	<p>Default content.</p>
          @show
						
          </div>
					<!--@section( 'info-blocks' )
						<div class='info-blocks'>
						</div>
					@show-->
					
        </div>
        <div id="sidebar" role="complementary">
          <div id="sidebar-inner">
            @foreach ( $page['sideblocks'] AS $sideblock )
              @include( $sideblock )
            @endforeach
          </div>
        </div>
    @else
  		  <div id="content" class='clearfix'>
					
					<!--@section( 'header-blocks' )
						<div class='header-blocks'>
						</div>
					@show-->
					
          <div id="content-area" class='clearfix'>
            @section( 'content' )
            	<p>Default content.</p>
            @show
          </div>
					
					<!--@section( 'info-blocks' )
						<div class='info-blocks'>
						</div>
					@show-->

        </div>
  	@endif
    </div>
  </div>
	
	@include( 'templates.includes.superfooter' )
	@include( 'templates.includes.footer' )	

</div>

<?php
	if ( isset( $page['js'] ) && file_exists( 'js/pages/' . $page['js'] . '.js' )) {
		echo '<script>';
		include 'js/pages/' . $page['js'] . '.js';
		echo '</script>';
	}
?>
<!-- Google Code for Remarketing Tag -->
<!--------------------------------------------------
Remarketing tags may not be associated with personally identifiable information or placed on pages related to sensitive categories. See more information and instructions on how to setup the tag on: http://google.com/ads/remarketingsetup
--------------------------------------------------->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 816538656;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/816538656/?guid=ON&amp;script=0"/>
</div>
</noscript>
<script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/3938123.js"></script> 
</body>
</html>
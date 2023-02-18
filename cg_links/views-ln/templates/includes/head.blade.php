<meta name="viewport" content="width=device-width, user-scalable=no">
<link rel="shortcut icon" type="image/x-icon" href="/img/favicon.ico">

<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700|Roboto:400,500,700,900" rel="stylesheet">

<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
{{--<link rel="stylesheet" href="/css/smoothness/jquery-ui-1.10.3.custom.css">--}}
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.css">

<link rel="stylesheet" href="/css/jquery.qtip.css">
<link rel="stylesheet" type="text/css" href="/css/colorbox.css">
<link rel="stylesheet" href="/css/jquery.sidr.dark.css">
{{--<link rel="stylesheet" type="text/css" href="/css/slidedeck.skin.css" media="screen" />--}}
<link rel="stylesheet" href="/css/flexslider.css">
{{--<link rel="stylesheet" href="/css/animate.min.css">--}}

<link rel="stylesheet" href="/css/app.css">

@if ( isset( $page['css'] ) AND file_exists( public_path() . '/css/pages/' . $page['css'] . '.css' ))
	<link rel="stylesheet" href="/css/pages/<?php echo $page['css']; ?>.css">
@endif

<script src="/js/jquery-1.9.1.js"></script>
<script src="/js/jquery-ui-1.10.3.custom.js"></script>
<script src="/js/jquery.sidr.min.js"></script>
<script src="/js/jquery.qtip.min.js"></script>
<script src="/js/jquery.flexslider.js"></script>
<script src="/js/main.js"></script>
<script src="https://use.fontawesome.com/69acfcdd49.js"></script>
<script type="text/javascript" src="/js/jquery.mousewheel.min.js"></script>
<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-sliderAccess.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.js"></script>

<?php
	$meta_keywords = \App\Setting::where( 'slug', 'analytics-keywords' )->first();
	$meta_description = \App\Setting::where( 'slug', 'analytics-description' )->first();
?>
<meta name="keywords" content="{{ $meta_keywords->body }}">
<meta name="description" content="{{ $meta_description->body }}">

<title>{{ !empty($title) ? $title.' | ' : null }}I95 Business</title>

<script>
/* Function to detect opted out users */
function __gaTrackerIsOptedOut() {
return document.cookie.indexOf(disableStr + '=true') > -1;
}

/* Disable tracking if the opt-out cookie exists. */
var disableStr = 'ga-disable-UA-9079470-3';
if ( __gaTrackerIsOptedOut() ) {
window[disableStr] = true;
}

/* Opt-out function */
function __gaTrackerOptout() {
 document.cookie = disableStr + '=true; expires=Thu, 31 Dec 2099 23:59:59 UTC; path=/';
 window[disableStr] = true;
}

(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','__gaTracker');

__gaTracker('create', 'UA-9079470-3', 'auto');
__gaTracker('set', 'forceSSL', true);
__gaTracker('send','pageview');
</script>

<!-- Taboola Pixel Code -->
<script type='text/javascript'>
  window._tfa = window._tfa || [];
  window._tfa.push({notify: 'event', name: 'page_view', id: 1141026});
  !function (t, f, a, x) {
         if (!document.getElementById(x)) {
            t.async = 1;t.src = a;t.id=x;f.parentNode.insertBefore(t, f);
         }
  }(document.createElement('script'),
  document.getElementsByTagName('script')[0],
  '//cdn.taboola.com/libtrc/unip/1141026/tfa.js',
  'tb_tfa_script');
</script>
<noscript>
  <img src='//trc.taboola.com/1141026/log/3/unip?en=page_view'
      width='0' height='0' style='display:none'/>
</noscript>
<!-- End of Taboola Pixel Code -->
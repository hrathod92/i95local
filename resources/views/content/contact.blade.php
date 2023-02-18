<?php 
$page['sideblocks'] = [ 'ad._block_ads_side' ];
  $page['css'] = 'dashboard'; 
?>

@extends( 'templates.default' )
@section( 'content' )

<div class="ctct-inline-form" data-form-id="e5d680c3-6a95-43c9-8fc2-94e8a0115837"></div>
<script> var _ctct_m = "f2a0c31266ca29e38df912fa7046e2d5";</script>
<script id="signupScript" src="//static.ctctcdn.com/js/signup-form-widget/current/signup-form-widget.min.js" async defer></script>
<script>
  $(window).bind('load', function(){
    $( 'form.ctct-form-custom' ).on('submit', function(event) {
      event.preventDefault();
      alert('Intercepted');    
      return;
    });
  });
</script>
@stop

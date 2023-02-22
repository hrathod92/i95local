<?php use App\Setting; ?>

<div id="footer" class='clearfix'>
  <div id="footer-inner">
	  <div class="footer-block social-media">{!! App\Block::where( 'slug', '=', 'footer-social-media' )->pluck( 'body' )->first() !!}</div>
	  <div class="footer-menu-copyright">
    	<div class="footer-block footer-menu">{!! \App\Menu::where( 'slug', '=', 'footer' )->first()->body !!}</div>
			<div class="footer-block footer-copyright">{!! App\Block::where( 'slug', '=', 'footer-copyright' )->pluck( 'body' )->first() !!}</div>
	  </div>
  </div>
</div>

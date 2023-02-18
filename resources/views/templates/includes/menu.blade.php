<?php 
	if ( isset( Auth::user()->role )) {
		$menu = \App\Menu::where( 'slug', '=', 'main-' . Auth::user()->role )->first();
	} else {
		$menu = \App\Menu::where( 'slug', '=', 'main-guest' )->first();
	}
?>

@if(isset($menu))
  {!! $menu->body !!}
@endif

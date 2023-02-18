	<div id="utility" class="clearfix" tabindex="-1" role="utility">
		<div id="utility-inner">
				<div class="utility-nav">
					<?php
						if ( Auth::check() && isset( Auth::user()->role )) {
							$utilityMenu = \App\Menu::where( 'slug', '=', 'utility-' . Auth::user()->role )->first();
						} else {
							$utilityMenu = \App\Menu::where( 'slug', '=', 'utility-guest' )->first();
						}
					?>
					@if( isset( $utilityMenu ))
						{!! $utilityMenu->body !!}
					@endif
				</div>
		</div>
	</div>

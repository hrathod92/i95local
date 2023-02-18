<?php 
	$blockSponsoreds = \App\Sponsored::orderBy( 'id' )->take( 4 )->get(); 
?>

<div class='fake-news-wrapper'>
	<h2>Today's News</h2>
	
	<div class="fake-articles">	
		@foreach ( $blockSponsoreds AS $blockSponsored )
			<div class="article">
				<div class="image-wrapper">
					<div class="image-crop">
						<a target='_blank' href='{{ $blockSponsored->url }}'>
							<img src="/data/sponsoreds/img/{{ $blockSponsored->image }}">
						</a>
					</div>
				</div>
			</div>
		@endforeach
	</div>

</div>

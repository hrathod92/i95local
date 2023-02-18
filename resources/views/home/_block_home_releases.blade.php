<?php 
	$blockReleases = \App\Release::where( 'image', '!=', '' )
    ->whereNotNull( 'image' )
    ->orderBy( 'id', 'desc' )
    ->take( 6 )
    ->get();
?>

<div class='fake-news-wrapper'>
	<h2>In the News -   <a href='/releases/'>Inbox</a></h2>
	
	<div class="fake-articles">	
		@foreach ( $blockReleases AS $blockRelease )
			<div class="article">
				<div class="image-wrapper">
					<div class="image-crop">
						<a target='_blank' href='/releases/{{ $blockRelease->id }}'>
							<img src="/data/releases/img/{{ $blockRelease->image }}" alt="{{ $blockRelease->title }}-{{ $blockRelease->pub_date }}">
						</a>
					</div>
				</div>
        <div class="title">
          <a target='_blank' href='/releases/{{ $blockRelease->id }}'>{{ $blockRelease->title }}</a>
        </div>
			</div>
		@endforeach
	</div>

</div>
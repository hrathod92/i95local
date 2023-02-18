<?php $page['title'] = $title . ' - Story'; ?>
<?php $page['css'] = 'campaign-show'; ?>

@extends( 'templates.default' )
@section( 'content' )


<div class="contributor-feature-wrapper">
	<div class="feature feature-large">
		<div class="image-wrapper">
			<div class="image-overlay"></div>
			<img src="http://via.placeholder.com/1920x1080">
		</div>
		<div class="text-wrapper">
			<span class="taxonomy"><a href="#">Environmental</a></span>
			<span class="shares hot"><i class="material-icons">whatshot</i> 28.4K</span>
			<div class="title"><a href="#">Curabitur at massa velneque arcu non leo vulputate aliquet</a></div>
		</div>
	</div>
	<div class="feature feature-small">
		<div class="image-wrapper">
			<div class="image-overlay"></div>
			<img src="http://via.placeholder.com/1920x1080">
		</div>
		<div class="text-wrapper">
			<span class="taxonomy"><a href="#">Tech</a></span>
			<span class="shares"><i class="material-icons">whatshot</i> 28.4K</span>
			<div class="title"><a href="#">Morbi tristique, nunc quis laoreet mattis</a></div>
		</div>
	</div>
	<div class="feature feature-small">
		<div class="image-wrapper">
			<div class="image-overlay"></div>
			<img src="http://via.placeholder.com/1920x1080">
		</div>
		<div class="text-wrapper">
			<span class="taxonomy"><a href="#">Entertainment</a></span>
			<span class="shares hot"><i class="material-icons">whatshot</i> 28.4K</span>
			<div class="title"><a href="#">Suspendisse hendrerit at odio</a></div>
		</div>
	</div>
</div>


<div class="latest-articles">
	<h2>Latest Articles</h2>
	<div class="article">
		<div class="text-wrapper">
			<span class="taxonomy"><a href="#">Environmental</a></span>
			<span class="shares hot"><i class="material-icons">whatshot</i> 28.4K</span>
			<div class="title"><a href="#">Curabitur at massa velneque arcu non leo vulputate aliquet</a></div>
			<div class="teaser">Cras maximus malesuada leo, sit amet blandit dolor porttitor a. Quisque fermentum venenatis dolor, ut semper quam molestie non. Donec mi velit, suscipit quis viverra ut, ullamcorper bibendum turpis. Vivamus libero nisi, accumsan fermentum ullamcorper vel, tincidunt eget lorem. Suspendisse interdum odio ante, id varius nisi luctus ut.</div>
		</div>
	</div>
	<div class="article">
		<div class="text-wrapper">
			<span class="taxonomy"><a href="#">Environmental</a></span>
			<span class="shares hot"><i class="material-icons">whatshot</i> 28.4K</span>
			<div class="title"><a href="#">Curabitur at massa velneque arcu non leo vulputate aliquet</a></div>
			<div class="teaser">Cras maximus malesuada leo, sit amet blandit dolor porttitor a. Quisque fermentum venenatis dolor, ut semper quam molestie non. Donec mi velit, suscipit quis viverra ut, ullamcorper bibendum turpis. Vivamus libero nisi, accumsan fermentum ullamcorper vel, tincidunt eget lorem. Suspendisse interdum odio ante, id varius nisi luctus ut.</div>
		</div>
	</div>
	<div class="article">
		<div class="text-wrapper">
			<span class="taxonomy"><a href="#">Environmental</a></span>
			<span class="shares hot"><i class="material-icons">whatshot</i> 28.4K</span>
			<div class="title"><a href="#">Curabitur at massa velneque arcu non leo vulputate aliquet</a></div>
			<div class="teaser">Cras maximus malesuada leo, sit amet blandit dolor porttitor a. Quisque fermentum venenatis dolor, ut semper quam molestie non. Donec mi velit, suscipit quis viverra ut, ullamcorper bibendum turpis. Vivamus libero nisi, accumsan fermentum ullamcorper vel, tincidunt eget lorem. Suspendisse interdum odio ante, id varius nisi luctus ut.</div>
		</div>
	</div>
	<div class="article">
		<div class="text-wrapper">
			<span class="taxonomy"><a href="#">Environmental</a></span>
			<span class="shares hot"><i class="material-icons">whatshot</i> 28.4K</span>
			<div class="title"><a href="#">Curabitur at massa velneque arcu non leo vulputate aliquet</a></div>
			<div class="teaser">Cras maximus malesuada leo, sit amet blandit dolor porttitor a. Quisque fermentum venenatis dolor, ut semper quam molestie non. Donec mi velit, suscipit quis viverra ut, ullamcorper bibendum turpis. Vivamus libero nisi, accumsan fermentum ullamcorper vel, tincidunt eget lorem. Suspendisse interdum odio ante, id varius nisi luctus ut.</div>
		</div>
	</div>
	<div class="article">
		<div class="text-wrapper">
			<span class="taxonomy"><a href="#">Environmental</a></span>
			<span class="shares hot"><i class="material-icons">whatshot</i> 28.4K</span>
			<div class="title"><a href="#">Curabitur at massa velneque arcu non leo vulputate aliquet</a></div>
			<div class="teaser">Cras maximus malesuada leo, sit amet blandit dolor porttitor a. Quisque fermentum venenatis dolor, ut semper quam molestie non. Donec mi velit, suscipit quis viverra ut, ullamcorper bibendum turpis. Vivamus libero nisi, accumsan fermentum ullamcorper vel, tincidunt eget lorem. Suspendisse interdum odio ante, id varius nisi luctus ut.</div>
		</div>
	</div>
</div>


<div class="contributor-videos">
	<h2>Videos</h2>
</div>

<!--
<div class="campaign">
    @if ( isset( $image ) && strlen( $image ) > 0 )
        <div class="campaign-image"><img src="/data/campaigns/img/{{ $image }}"></div>
    @endif
    <p class='campaign-body'>Description: {!! $body !!}</p>
</div>
-->

@if ( Auth::check() && Auth::user()->role == 'admin' )
    <p><a href='/campaigns/{{ $id }}/edit'>edit</a></p>
@endif

@stop
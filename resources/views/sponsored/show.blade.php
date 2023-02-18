<?php $page['title'] = 'Sponsored Ad - ' . $title; ?>
<?php $page['css'] = 'sponsored-show'; ?>

@extends( 'templates.default' )
@section( 'content' )

<div class="article">
	<div class='sponsored-image'><img src='/data/sponsoreds/img/{{ $image }}' /></div>
	<div class='sponsored-description'>{{ $body }}</div>
</div>

@if ( Auth::check() && Auth::user()->role == 'admin' )
    <p><a href='/sponsoreds/{{ $id }}/edit'>edit</a></p>
@endif

@stop
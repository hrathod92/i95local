<?php $page['title'] = 'Sponsoreds'; ?>
<?php $page['css'] = 'sponsored-index'; ?>

@extends( 'templates.default' )
@section( 'content' )

<div class='sponsoreds'>
    @foreach ( $sponsoreds AS $sponsored )
        <div class="sponsored">
            <div class="sponsored-title"><a href="/sponsoreds/{{ $sponsored->id }}">{{ $sponsored->title }}</a></div>
            <div class="sponsored-description">{{ $sponsored->body }}</div>
        </div>
    @endforeach
</div>

@stop

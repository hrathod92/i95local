<?php $page['title'] = 'Demos'; ?>
<?php $page['css'] = 'demo-index'; ?>

@extends( 'templates.default' )
@section( 'content' )

<div class='demos'>
    @foreach ( $demos AS $demo )
        <div class="demo">
            <div class="demo-title"><a href="/demos/{{ $demo->id }}">{{ $demo->title }}</a></div>
            <div class="demo-description">{{ $demo->body }}</div>
        </div>
    @endforeach
</div>

@stop

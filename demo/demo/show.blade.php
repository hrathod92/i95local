<?php $page['title'] = 'Demo - ' . $title; ?>
<?php $page['css'] = 'demo-show'; ?>

@extends( 'templates.default' )
@section( 'content' )

<div class="demo">
    @if ( isset( $image ) && strlen( $image ) > 0 )
        <div class="demo-image"><img src="/data/demos/img/{{ $image }}"></div>
    @endif
    <p class='demo-body'>Description: {!! $body !!}</p>
</div>

@if ( Auth::check() && Auth::user()->role == 'admin' )
    <p><a href='/demos/{{ $id }}/edit'>edit</a></p>
@endif

@stop
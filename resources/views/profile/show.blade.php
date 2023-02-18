<?php $page['title'] = 'Profile - ' . $title; ?>
<?php $page['css'] = 'profile-show'; ?>

@extends( 'templates.default' )
@section( 'content' )

<div class="profile">
    @if ( isset( $image ) && strlen( $image ) > 0 )
        <div class="profile-image"><img src="/data/profiles/img/{{ $image }}"></div>
    @endif
    <p class='profile-body'>Description: {!! $body !!}</p>
</div>

@if ( Auth::check() && Auth::user()->role == 'admin' )
    <p><a href='/profiles/{{ $id }}/edit'>edit</a></p>
@endif

@stop
<?php $page['title'] = 'Account - ' . $title; ?>
<?php $page['css'] = 'account-show'; ?>

@extends( 'templates.default' )
@section( 'content' )

<div class="account">
    @if ( isset( $image ) && strlen( $image ) > 0 )
        <div class="account-image"><img src="/data/accounts/img/{{ $image }}"></div>
    @endif
    <p class='account-body'>Description: {!! $body !!}</p>
</div>

@if ( Auth::check() && Auth::user()->role == 'admin' )
    <p><a href='/accounts/{{ $id }}/edit'>edit</a></p>
@endif

@stop
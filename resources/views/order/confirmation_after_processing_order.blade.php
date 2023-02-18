<?php $page['css'] = 'order-subscription'; ?>

@extends( 'templates.default' )
@section( 'content' )
    @if($user = \Auth::user())
        {!! \App\Content::whereSlug("user-purchase-confirmation")->first()->body !!}
    @else
        {!! \App\Content::whereSlug("guest-purchase-confirmation")->first()->body !!}
    @endif

@stop
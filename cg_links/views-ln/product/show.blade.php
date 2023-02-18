<?php
    $page['title'] = 'Product';
    if(\Auth::user()->role == 'admin')
    {
        $page['sideblocks'] = [ 'dashboard._block_admin' ];
    }
    else 
    {
        $page['sideblocks'] = [ 'dashboard._block_user' ];    
    }
    $page['css'] = 'dashboard';
?>

@extends( 'templates.default' )
@section( 'content' )

<div class="item-page">
    <div class='item-wrapper'>
        <h2 class='title'>{!! $title !!}</h2>
        <div class="price"><strong>Tagline:</strong>{{ $tagline }}</div>
        <div class="body" style="margin-bottom: 1.5em;">
          {!! nl2br( $body ) !!}
        </div>
        <div class="status"><strong>Type:</strong> {{ $product_type['title'] }}</div>
        <div class="price"><strong>Price:</strong> ${{ $price }}</div>
        <div class="status"><strong>Status:</strong> {{ $status['title'] }}</div>
        @if ( Auth::check() && (Auth::user()->role == 'admin'))
            <div><strong>Stripe Plan ID:</strong> {{ $stripe_plan_id}}</div>
            <p>&nbsp;</p>
            <p><a class="button small" href='/products/{{ $id }}/edit'>edit</a></p>
        @endif
    </div>
</div>

@stop
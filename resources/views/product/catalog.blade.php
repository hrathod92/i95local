<?php
  $page['title'] = 'Products';
  $page['sideblocks'] = ['content._block_content'];
?>

@extends( 'templates.default' )

@section('head')
	<meta property="og:url"           	content="{{ Request::fullUrl() }}" /></meta>
  	<meta property="og:type"          	content="website" /></meta>
  	<meta property="og:title"         	content="Product Offerings | I95 Business" /></meta>
  	<meta property="og:description"   	content="Advertising Products and other offerings from I95 Business" /></meta>
    <title>Product Offerings | I95 Business</title>
@endsection

@section( 'content' )

<div class='products'>
    @if ( isset( $items ))
        @foreach ( $items AS $item )
          <div class='product'>
            <div class="title" data-label="Product"><a href="/products/{{ $item->id }}">{{ $item->title }}</a></div>
            <div class="tagline align-center nowrap" data-label="Tagline">{{$item->tagline}}</div>
            <div class="price align-center nowrap" data-label="Price">$ {{$item->price}} {{$item->product_type['title'] }}</div>
            <div class="body align-left nowrap" data-label="Body" style="overflow: auto; max-height: 65%;">{!! nl2br( $item->body) !!}</div>
            <div class='order align-center nowrap'><a class='button small' href='/orders/subscription'>Order</a></div>
          </div>
        @endforeach
    @endif
</div>

<style>
  .products { 
    margin-bottom: 2em;
  }
  .products .product {
    display: inline-block;
    vertical-align: top;
    position: relative;
    width: 30%;
    height: 44em;
    margin: 0 0.5% 2em;
    padding: 0;
    border: 1px solid #06367d;
  }
  .products .product .title {
    background: #06367d;
    color: white;
    font-size: 1.1em;
    font-weight: bold;
    text-align: center;
    padding: 1em 0.5em;
  }
  .products .product .title a  {
    color: white;
    text-decoration:none;
  }
  .products .product .tagline,
  .products .product .price {
    margin: 0.5em;
    font-size: 1.25em;
    font-weight: bold;
  }
  .products .product .body {
    margin: 0.5em 0;
    padding: 0 1em;
    line-height: 2em;
    text-align: left;
    font-size: 0.9em;
  }
  .products .product .order {
    position: absolute;
    left: 0;
    right: 0;
    bottom: 1em;
  }
  .products .product .align-center {
    text-align: center;
  }
  #sidebar #sidebar-inner .content-sidebar {
    width: 100%;
  }
</style>
    
@stop

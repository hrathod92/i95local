<?php
$page['title'] = 'Products';
$page['sideblocks'] = ['dashboard._block_admin'];
$page['css'] = 'dashboard';
?>

@extends( 'templates.default' )
@section( 'content' )

    <p>
        <a class='button small icon-left' href="/products/create"><i class="fa fa-plus"></i>Create New Product</a>
    </p>

    <table>
      <thead>
        <tr>
          <th>Product</th>
          <th>Tagline</th>
          <th class="align-center">Type</th>
          <th class="align-center">Price</th>
          <th class="align-center">Status</th>
          <th class="align-center"></th>
        </tr>
      </thead>
      <tbody>
        @if ( isset( $items ))
            @foreach ( $items AS $item )
            <tr>
              <td class="title" data-label="Product"><a href="/products/{{ $item->id }}">{{ $item->title }}</a></td>
              <td class="price align-center nowrap" data-label="Tagline">{{$item->tagline}}</td>
              <td class="price align-center nowrap" data-label="Price">{{$item->product_type['title'] }}</td>
              <td class="price align-center nowrap" data-label="Price">{{$item->price}}</td>
              <td class="price align-center nowrap" data-label="Price">{{$item->status['title'] }}</td>
              <td class='edit align-center nowrap'><a class='button small' href='/products/{{ $item->id }}/edit'>Edit</a></td>
            </tr>
            @endforeach
        @endif
      </tbody>
    </table>
    
@stop

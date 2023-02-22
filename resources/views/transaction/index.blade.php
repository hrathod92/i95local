<?php
$page['title'] = 'Order History';
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
    
    {!! Form::open(['url' => '/transaction/filter']) !!}
      <div class="form-element label-inline">
        {!! Form::label('account','Account:') !!}
        @if(\Auth::user()->role != 'admin')
          {!! Form::select( 'account', [''=>''] + \Auth::user()->accounts->pluck( 'title', 'id' )->all(), isset( $request ) ? $request->input('account') : '' ) !!}
        @else
          {!! Form::select( 'account', [''=>''] + \App\Account::orderBy('title')->get()->pluck( 'title', 'id' )->all(), isset( $request ) ? $request->input('account') : '' ) !!}
        @endif
      </div>
      {!! Form::submit( 'Search', array('class'=>'btn btn-large btn-primary btn-block' )) !!}
    {!! Form::close() !!}
    
    <table>
      <thead>
        <tr>
          <th class="align-center">Order</th>
          <th>Title</th>
          <th class="align-center">Created</th>
          <th class="align-center nowrap">Shipped On</th>
          <th class="align-center">Total</th>
          <th class="align-center">Items</th>
          <th class="align-center"></th>
        </tr>
      </thead>
      <tbody>
        @if ( isset( $items ))
            @foreach ( $items AS $item )
            <?php 
              $order = \App\Order::find($item->order_id)->first();
            ?>
            <tr>
              <td class="id align-center nowrap" data-label="Order"><a href="/orders/{{ $order->id }}">{{ $order->id }}</a></td>
              <td class="account" data-label="Title">{{ \App\Account::find($item->account_id)->first()->title }}</td>
              <td class="align-center nowrap" data-label="Created">{{ $item->created_at }}</td>
              <td class="align-center nowrap" data-label="Shipped">{{ $item->shipped_on }}</td>
              <td class="total align-center nowrap" data-label="Total">${{$item->total}}</td>
              <td class="orderitems align-center nowrap" data-label="Items">{{ $item->transactionItems->count() }} items</td>
              <td class='edit align-center nowrap'>
                <a class='button small' href='/transactions/{{ $item->id }}'>View</a>
              </td>
            </tr>
            @endforeach
        @endif
      </tbody>
    </table>
    
@stop
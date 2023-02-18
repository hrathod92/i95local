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

<div class="item-page">
    <div class='item-wrapper'>
      <h2 class='title'>Order - {!! \App\Order::find($order_id)->id !!}</h2>
        <div>{{\App\Account::find($account_id)->title}}</div>
        <div>Created: {{$created_at}}</div>
        <div>Shipped On: {{$shipped_on}}</div>
        @if(isset($id) && $id > 0)
            <h2>Products</h2>
            <table>
              <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
              </thead>
              <tbody>
                <?php $transactionItems = \App\TransactionItem::where('transaction_id' , '=', $id)->get(); ?>
                @foreach($transactionItems as $transactionItem)
                    <?php $product = \App\Product::find($transactionItem->product_id); ?>
                    <tr>
                        <td data-label="Product">
                            @if($product->image != null && strlen($product->image) > 0)
                                <img style="max-width: 100px" src="/data/product_images/{{$product->image}}"/>
                            @endif
                            {{$product->title}}</td>
                        <td class="align-center nowrap" data-label="Qty">{{$transactionItem->quantity}}</td>
                        <td class="align-center nowrap" data-label="Price">${{$product->price * $transactionItem->quantity}}</td>
                    </tr>
                @endforeach
              </tbody>
            </table>
            <h2>Total: ${{$total}}</h2>
        @endif
    </div>
</div>
@if ( Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'sales'))
    <div class="actions bottom"><a class="btn small" href='/transactions/{{ $id }}/edit'>Edit</a></div>
@endif

@stop
<?php $page['title'] = 'Order - Edit'; ?>
<?php $page['css'] = 'order-edit'; ?>

@extends( 'templates.default' )
@section( 'content' )

{!! Form::model( $order, [ 'method' => 'PATCH', 'route' => [ 'orders.update', $order->id ]]) !!}

    @include( 'order._edit' )
    
{!! Form::close() !!}

@stop

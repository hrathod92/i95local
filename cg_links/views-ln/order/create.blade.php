<?php $page['title'] = 'Order - Create'; ?>
<?php $page['css'] = 'order-create'; ?>

@extends( 'templates.default' )
@section( 'content' )

{!! Form::model( new App\Order, ['route' => [ 'orders.store' ], 'class'=>'' ]) !!}

    @include( 'order._edit' )
    
{!! Form::close() !!}

@stop
<?php
    $page['title'] = 'Product - Create';
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

{!! Form::model( new App\Product, ['route' => [ 'products.store' ], 'class'=>'', 'files' => true ]) !!}
  @include( 'product._edit' )
{!! Form::close() !!}

@stop

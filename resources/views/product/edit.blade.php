<?php
    $page['title'] = 'Product - Edit';
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

{!! Form::model( $item, [ 'method' => 'PATCH', 'route' => [ 'products.update', $item->id ], 'files' => true]) !!}
  @include( 'product._edit' )
{!! Form::close() !!}

@stop

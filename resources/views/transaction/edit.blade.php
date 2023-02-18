<?php
    $page['title'] = 'Order History - Edit';
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

{!! Form::model( $item, [ 'method' => 'PATCH', 'route' => [ 'transactions.update', $item->id ], 'files' => true]) !!}

    {!! Form::label( 'shipped_on', 'Shipped On' ) !!}
    {!! Form::text( 'shipped_on', $item->shipped_on, array('class' => 'datepicker') ) !!}
    
    {!! Form::submit( 'Submit', array('class'=>'btn btn-large btn-primary btn-block' )) !!}

{!! Form::close() !!}

@stop

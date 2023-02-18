<?php $page['title'] = 'Demo - Edit'; ?>
<?php $page['css'] = 'demo-edit'; ?>

@extends( 'templates.default' )
@section( 'content' )

{!! Form::model( $demo, [ 'method' => 'PATCH', 'route' => [ 'demos.update', $demo->id ]]) !!}

    @include( 'demo._edit' )
    
{!! Form::close() !!}

@stop

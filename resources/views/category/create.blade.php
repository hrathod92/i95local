<?php
    $page['title'] = 'Category - Create';
    $page['sideblocks'] = [ 'dashboard._block_admin' ];
    $page['css'] = 'dashboard';
?>

@extends( 'templates.default' )
@section( 'content' )

{!! Form::model( $item, ['route' => [ 'categories.store' ], 'class'=>'', 'files' => true ]) !!}
    @include( 'category._edit' )
{!! Form::close() !!}

@stop

<?php 
    $page['title'] = 'Menu - Create';
    $page['sideblocks'] = [ 'dashboard._block_admin' ];
    $page['css'] = 'dashboard';
?>

@extends( 'templates.default' )
@section( 'content' )

{!! Form::model( new App\Menu, ['route' => [ 'menus.store' ], 'class'=>'' ]) !!}
    @include( 'menu._edit' )
{!! Form::close() !!}

@stop
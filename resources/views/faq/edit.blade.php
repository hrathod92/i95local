<?php 
$page['title'] = 'Faq - Edit'; 
$page['sideblocks'] = [ 'faq._block_sidebar' ];
$page['css'] = 'faq-edit'; 
?>

@extends( 'templates.default' )
@section( 'content' )

{!! Form::model( $faq, [ 'method' => 'PATCH', 'route' => [ 'faqs.update', $faq->id ]]) !!}

    @include( 'faq._edit' )
    
{!! Form::close() !!}

@stop

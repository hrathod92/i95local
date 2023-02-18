<?php 
$page['title'] = 'Faq - Create';
$page['sideblocks'] = [ 'faq._block_sidebar' ];
$page['css'] = 'faq-create';
?>

@extends( 'templates.default' )
@section( 'content' )

{!! Form::model( new App\Faq, ['route' => [ 'faqs.store' ], 'class'=>'' ]) !!}
   @include( 'faq._edit' )
{!! Form::close() !!}

@stop
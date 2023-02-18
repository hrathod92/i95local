<?php $page['title'] = 'Ad - Edit'; ?>
<?php $page['css'] = 'ad-edit'; ?>

@extends( 'templates.default' )
@section( 'content' )

{!! Form::model( $ad, [ 'method' => 'PATCH', 'route' => [ 'ads.update', $ad->id ], 'files' => true ]) !!}
  @include( 'ad._edit' )
{!! Form::close() !!}   

@stop

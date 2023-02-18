<?php $page['title'] = 'Hero Slider - Edit'; ?>
<?php $page['css'] = 'block-edit'; ?>

@extends( 'templates.default' )
@section( 'content' )

{!! Form::model( $slider, [ 'method' => 'PATCH', 'route' => [ 'sliders.update', $slider->id ], 'files' => true ]) !!}
  @include( 'hero_slider._edit' )
{!! Form::close() !!}

@stop

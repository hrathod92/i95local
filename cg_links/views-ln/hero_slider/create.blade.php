<?php $page['title'] = 'Hero Slider - Create'; ?>
<?php $page['css'] = 'block-create'; ?>

@extends( 'templates.default' )
@section( 'content' )

{!! Form::model( new App\Setting, ['route' => [ 'sliders.store' ], 'class'=>'', 'files' => true ]) !!}
    @include( 'hero_slider._edit' )
{!! Form::close() !!}

@stop
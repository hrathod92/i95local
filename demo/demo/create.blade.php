<?php $page['title'] = 'Demo - Create'; ?>
<?php $page['css'] = 'demo-create'; ?>

@extends( 'templates.default' )
@section( 'content' )

{!! Form::model( new App\Demo, ['route' => [ 'demos.store' ], 'class'=>'' ]) !!}

    @include( 'demo._edit' )
    
{!! Form::close() !!}

@stop
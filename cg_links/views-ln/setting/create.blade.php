<?php $page['title'] = 'Setting - Create'; ?>
<?php $page['css'] = 'setting-create'; ?>

@extends( 'templates.default' )
@section( 'content' )

{!! Form::model( new App\Setting, ['route' => [ 'settings.store' ], 'class'=>'' ]) !!}

    @include( 'setting._edit' )
    
{!! Form::close() !!}

@stop
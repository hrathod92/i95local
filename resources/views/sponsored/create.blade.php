<?php $page['title'] = 'Sponsored - Create'; ?>
<?php $page['css'] = 'company-create'; ?>

@extends( 'templates.default' )
@section( 'content' )

{!! Form::model( new App\Sponsored, ['route' => [ 'sponsoreds.store' ], 'class'=>'' ]) !!}

    @include( 'sponsored._edit' )
    
{!! Form::close() !!}

@stop
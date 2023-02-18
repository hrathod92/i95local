<?php $page['title'] = 'Campaign - Create'; ?>
<?php $page['css'] = 'company-create'; ?>

@extends( 'templates.default' )
@section( 'content' )

{!! Form::model( new App\Campaign, ['route' => [ 'campaigns.store' ], 'class'=>'' ]) !!}

    @include( 'company._edit' )
    
{!! Form::close() !!}

@stop
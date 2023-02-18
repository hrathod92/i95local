<?php $page['title'] = 'Publication - Create'; ?>
<?php $page['css'] = 'newsletter-create'; ?>

@extends( 'templates.default' )
@section( 'content' )

{!! Form::model( new App\Newsletter, [ 'route' => [ 'newsletters.store' ], 'class'=>'', 'files' => true ]) !!}

    @include( 'newsletter._edit' )
    
{!! Form::close() !!}

@stop
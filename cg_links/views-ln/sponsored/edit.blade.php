<?php $page['title'] = 'Sponsored - Edit'; ?>
<?php $page['css'] = 'sponsored-edit'; ?>

@extends( 'templates.default' )
@section( 'content' )

{!! Form::model( $sponsored, [ 'method' => 'PATCH', 'route' => [ 'sponsoreds.update', $sponsored->id ], 'files' => true ]) !!}

    @include( 'sponsored._edit' )
    
{!! Form::close() !!}

@stop

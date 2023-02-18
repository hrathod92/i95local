<?php $page['title'] = 'Author - Edit'; ?>
<?php $page['css'] = 'authors'; ?>

@extends( 'templates.default' )
@section( 'content' )

{!! Form::model( $author, [ 'method' => 'PATCH', 'route' => [ 'authors.update', $author->id ], 'files' => true ]) !!}

    @include( 'author._edit' )
    
{!! Form::close() !!}

@stop

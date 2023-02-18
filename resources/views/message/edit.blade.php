<?php $page['title'] = 'Message - Edit'; ?>
<?php $page['css'] = 'messages'; ?>

@extends( 'templates.default' )
@section( 'content' )

{!! Form::model( $message, [ 'method' => 'PATCH', 'route' => [ 'messages.update', $message->id ], 'files' => true ]) !!}

    @include( 'message._edit' )
    
{!! Form::close() !!}

@stop

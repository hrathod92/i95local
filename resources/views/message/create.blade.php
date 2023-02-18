<?php $page['title'] = 'Message - Create'; ?>
<?php $page['css'] = 'messages'; ?>

@extends( 'templates.default' )
@section( 'content' )

{!! Form::model( new App\Message, ['route' => [ 'messages.store' ], 'class'=>'' ], "files" => true ) !!}

    @include( 'message._edit' )
    
{!! Form::close() !!}

@stop
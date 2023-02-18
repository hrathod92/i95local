<?php $page['title'] = 'Feed - Create'; ?>
<?php $page['css'] = 'block-create'; ?>

@extends( 'templates.default' )
@section( 'content' )

{!! Form::model( new App\Feed, ['route' => [ 'feeds.store' ], 'class'=>'', 'files' => true ]) !!}
    @include( 'feed._edit' )
{!! Form::close() !!}

@stop
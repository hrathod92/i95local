<?php $page['title'] = 'Feed - Edit'; ?>
<?php $page['css'] = 'block-edit'; ?>

@extends( 'templates.default' )
@section( 'content' )

{!! Form::model( $item, [ 'method' => 'PATCH', 'route' => [ 'feeds.update', $item->id ], 'files' => true ] ) !!}
  @include( 'feed._edit' )
{!! Form::close() !!}  


@stop

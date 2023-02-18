<?php $page['title'] = 'Publication - Edit'; ?>
<?php $page['css'] = 'newsletter-edit'; ?>

@extends( 'templates.default' )
@section( 'content' )

{!! Form::model( $newsletter, [ 'method' => 'PATCH', 'route' => [ 'newsletters.update', $newsletter->id ], 'files' => true ]) !!}
  @include( 'newsletter._edit' )
{!! Form::close() !!}

@stop

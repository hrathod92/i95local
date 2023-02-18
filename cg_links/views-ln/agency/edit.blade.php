<?php $page['title'] = 'Agency - Edit'; ?>
<?php $page['css'] = 'company-edit'; ?>

@extends( 'templates.default' )
@section( 'content' )

{!! Form::model( $company, [ 'method' => 'PATCH', 'route' => [ 'agency.update', $company->id ], 'files' => true ] ) !!}
  @include( 'agency._edit' )
{!! Form::close() !!}

@stop

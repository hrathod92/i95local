<?php $page['title'] = 'Company - Edit'; ?>
<?php $page['css'] = 'company-edit'; ?>

@extends( 'templates.default' )
@section( 'content' )

{!! Form::model( $company, [ 'method' => 'PATCH', 'route' => [ 'companies.update', $company->id ], 'files' => true ] ) !!}
  @include( 'company._edit' )
{!! Form::close() !!}

@stop

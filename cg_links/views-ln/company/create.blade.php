<?php $page['title'] = 'Company - Create'; ?>
<?php $page['css'] = 'company-create'; ?>

@extends( 'templates.default' )
@section( 'content' )

{!! Form::model( new App\Company, ['route' => [ 'companies.store' ], 'class'=>'', 'files' => true ] ) !!}
  @include( 'company._edit' )
{!! Form::close() !!}

@stop

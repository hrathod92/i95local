<?php $page['title'] = 'Agency - Create'; ?>
<?php $page['css'] = 'company-create'; ?>

@extends( 'templates.default' )
@section( 'content' )

{!! Form::model( new App\Company, ['route' => [ 'agency.store' ], 'class'=>'', 'files' => true ] ) !!}
  @include( 'agency._edit' )
{!! Form::close() !!}

@stop

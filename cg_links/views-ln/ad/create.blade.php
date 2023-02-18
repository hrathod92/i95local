<?php $page['title'] = 'Ad - Create'; ?>
<?php $page['css'] = 'ad-create'; ?>

@extends( 'templates.default' )
@section( 'content' )

{!! Form::model( $ad, ['route' => [ 'ads.store' ], 'class'=>'', 'files' => true ]) !!}
    @include( 'ad._edit' )
{!! Form::close() !!}

@stop
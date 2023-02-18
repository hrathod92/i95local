<?php $page['title'] = 'Ad - Create'; ?>
<?php $page['css'] = 'ad-create'; ?>

@extends( 'templates.default' )
@section( 'content' )

{!! Form::model(\App\Ad::create(), ['method' => 'PATCH', 'route' => ['agency.ad.store', $id], 'files' => true]) !!}
    @include( 'agency.ad._edit' )
{!! Form::close() !!}

@stop
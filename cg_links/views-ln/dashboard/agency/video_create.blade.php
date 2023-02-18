<?php $page['title'] = 'Video - Create'; ?>
<?php $page['css'] = 'video-create'; ?>

@extends( 'templates.default' )
@section( 'content' )

{!! Form::model(\App\Video::create(), ['method' => 'PATCH', 'route' => ['agency.video.store', $id], 'files' => true]) !!}
    @include( 'agency.video._edit' )
{!! Form::close() !!}

@stop
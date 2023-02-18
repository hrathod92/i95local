<?php $page['title'] = 'Video - Edit'; ?>
<?php $page['css'] = 'video-edit'; ?>

@extends( 'templates.default' )
@section( 'content' )

{!! Form::model( $video, [ 'method' => 'PATCH', 'route' => [ 'videos.update', $video->id ]] ) !!}
  @include( 'video._edit' ) 
{!! Form::close() !!}

@stop

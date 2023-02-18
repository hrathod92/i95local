<?php $page['title'] = 'Video Type - Edit'; ?>
<?php $page['css'] = 'video-type-edit'; ?>

@extends( 'templates.default' )
@section( 'content' )

@if( ! empty($message))
	<p class="videos-required-email-fail">{!! $message !!}</p>
@endif

{!! Form::model( $item, [ 'method' => 'PATCH', 'route' => [ 'video-types.update', $item->id ]]) !!}
    @include( 'video-type._edit' )
{!! Form::close() !!}

@stop

<?php $page['title'] = 'Video Type - Create'; ?>
<?php $page['css'] = 'video-type-create'; ?>

@extends( 'templates.default' )
@section( 'content' )

@if( ! empty($message))
	<p class="videos-required-email-fail">{!! $message !!}</p>
@endif

{!! Form::model( new App\VideoType, ['route' => [ 'video-types.store' ], 'class'=>'' ]) !!}

    @include( 'video-type._edit' )
    
{!! Form::close() !!}

@stop
<?php $page['title'] = 'Job Type - Create'; ?>
<?php $page['css'] = 'job-type-create'; ?>

@extends( 'templates.default' )
@section( 'content' )

@if( ! empty($message))
	<p class="jobs-required-email-fail">{!! $message !!}</p>
@endif

{!! Form::model( new App\JobType, ['route' => [ 'job-types.store' ], 'class'=>'' ]) !!}

    @include( 'job-type._edit' )
    
{!! Form::close() !!}

@stop
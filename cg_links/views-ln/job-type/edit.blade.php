<?php $page['title'] = 'Job Type - Edit'; ?>
<?php $page['css'] = 'job-type-edit'; ?>

@extends( 'templates.default' )
@section( 'content' )

@if( ! empty($message))
	<p class="jobs-required-email-fail">{!! $message !!}</p>
@endif

{!! Form::model( $item, [ 'method' => 'PATCH', 'route' => [ 'job-types.update', $item->id ]]) !!}

    @include( 'job-type._edit' )
    
{!! Form::close() !!}

@stop

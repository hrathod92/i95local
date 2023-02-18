<?php $page['title'] = 'Email Required'; ?>
<?php $page['css'] = 'job-email-required'; ?>

@extends( 'templates.default' )
@section ( 'content' )

@if( ! empty( $message ))
	<div class="form-fail-message">{!! $message !!}</div>
@endif

{!! Form::open( array('url'=>'/jobs/email-required', 'class'=>'form-signin email-required-form' )) !!}

	{!! Form::hidden( 'id', session()->get( 'current-job-id' )) !!}

	{!! Form::label( 'email', 'Please enter your email address to view this job listing.' ) !!}
	{!! Form::text('email', null, array('class'=>'input-block-level email-required-txt', 'placeholder'=>'Email Address')) !!}

	{!! Form::submit( 'Submit', array('class'=>'btn btn-large btn-primary btn-block email-required-btn' )) !!}	

{!! Form::close() !!}

@stop

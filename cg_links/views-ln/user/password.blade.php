<?php $page['title'] = 'Password Reset'; ?>
<?php $page['css'] = 'user-login'; ?>

@extends( 'templates.default' )
@section ( 'content' )

@if( ! empty($message))
	<p class="email-fail">{!! $message !!}</p>
@endif

{!! Form::open( array('url'=>'/user/password', 'class'=>'form-signin' )) !!}

	{!! Form::label( 'email', 'Email' ) !!}
	{!! Form::text('email', null, array('class'=>'input-block-level', 'placeholder'=>'Email Address')) !!}

	{!! Form::submit( 'Submit', array('class'=>'btn btn-large btn-primary btn-block' )) !!}	

{!! Form::close() !!}

@stop 
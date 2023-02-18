<?php $page['title'] = 'Login'; ?>
<?php $page['css'] = 'user-login'; ?>

@extends( 'templates.default' )
@section('head')
	<meta property="og:url"           content="{{ Request::fullUrl() }}" />
  	<meta property="og:type"          content="website" />
  	<meta property="og:title"         content="Login | I95 Business" />
  	<meta property="og:description"   content="Login | I95 Business" />
<title>Login | I95 Business</title>
@endsection
@section ( 'content' )

<div class="login-intro">
	<p>
		Welcome to the login page of the I95 Business magazine Website. Please enter your credentials.
	</p>
</div>

@if ( \Session::has( 'message' ))
	<p id='login-message'>{!! \Session::get( 'message' ) !!}</p>
@endif

{!! Form::open(array('url'=>'/user/login', 'class'=>'form-signin')) !!}

	{!! Form::text('email', null, array('class'=>'input-block-level', 'placeholder'=>'Email Address')) !!}
	{!! Form::password('password', array('class'=>'input-block-level', 'placeholder'=>'Password')) !!}

	{!! Form::button('<i class="fa fa-check-circle" aria-hidden="true"></i>Sign-in', array('class'=>'btn icon-left','type'=>'submit')) !!}

{!! Form::close() !!}

<div class="form-help-actions">
  <div><a href='/user/password'>I forgot my password</a></div>
</div>

@stop

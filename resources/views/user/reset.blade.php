<?php $page['title'] = 'Password Reset'; ?>
<?php $page['css'] = 'dashboard'; ?>

@extends( 'templates.default' )
@section ( 'content' )

<ul>
  @foreach( $errors->all() as $error )
    <li>{!! $error !!}</li>
  @endforeach
</ul>

{!! Form::open(array('url'=>'/user/reset', 'class'=>'form-signup')) !!}

	{!! Form::hidden( 'id', $id ) !!}

	{!! Form::label('password', 'Password') !!}
	{!! Form::password('password', array('class'=>'input-block-level', 'placeholder'=>'Password')) !!}

	{!! Form::label('password_confirmation', 'Confirm Password') !!}
	{!! Form::password('password_confirmation', array('class'=>'input-block-level', 'placeholder'=>'Confirm Password')) !!}

	{!! Form::submit('Reset', array('class'=>'btn btn-large btn-primary btn-block'))!!}

{!! Form::close() !!}

@stop

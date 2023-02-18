<?php $page['title'] = 'Create User Profile'; ?>
<?php if ( Auth::check() && Auth::user()->roles == 'admin' ) $page['sideblocks'] = [ 'dashboard._block_admin' ]; ?>
<?php $page['css'] = 'user-create'; ?>
<?php $page['js'] = 'user'; ?>

@extends( 'templates.default' )
@section ( 'content' )


{!! Form::open(array('url'=>'/user/create', 'class'=>'form-signup')) !!}

<ul>
	@foreach($errors->all() as $error)
		<li>{!! $error !!}</li>
	@endforeach
</ul>

{!! Form::label('first_name', 'First Name') !!}
{!! Form::text('first_name', null, array('class'=>'input-block-level', 'placeholder'=>'First Name')) !!}

{!! Form::label('last_name', 'Last Name') !!}
{!! Form::text('last_name', null, array('class'=>'input-block-level', 'placeholder'=>'Last Name')) !!}

{!! Form::label('phone', 'Phone') !!}
{!! Form::text('phone', null, array('class'=>'input-block-level', 'placeholder'=>'XXX-XXX-XXXX')) !!}

{!! Form::label('email', 'Email') !!}
{!! Form::text('email', null, array('class'=>'input-block-level', 'placeholder'=>'Email Address')) !!}

@if ( \Auth::user()->role == 'admin' )
	<?php 
    $companyList = App\Company::orderBy( 'title' )->lists( 'title', 'id' );
    $companyList->prepend('None', 0);
  ?>

  {!! Form::label( 'company_id', 'Company') !!}
  {!! Form::select( 'company_id', $companyList) !!}

  {!! Form::label( 'role', 'Role') !!}
  {!! Form::select( 'role', App\Role::orderBy( 'id' )->lists( 'title', 'slug' )) !!}

  {!! Form::Label( 'user_status_id', 'Status' ) !!}
  {!! Form::select( 'user_status_id', App\UserStatus::orderBy( 'id' )->lists( 'title', 'id' )) !!}

@endif

{!! Form::submit('Submit', array('class'=>'btn btn-large btn-primary btn-block button-submit' )) !!}

{!! Form::close() !!}

@stop

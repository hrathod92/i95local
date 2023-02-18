{!! Form::label('first_name', 'First' ) !!}
{!! Form::text( 'first_name' ) !!}

{!! Form::label('last_name', 'Last Name' ) !!}
{!! Form::text( 'last_name' ) !!}

{!! Form::label('phone', 'Phone') !!}
{!! Form::text('phone', null, array('class'=>'input-block-level', 'placeholder'=>'XXX-XXX-XXXX')) !!}

{!! Form::label('email', 'Email' ) !!}
{!! Form::text( 'email' ) !!}

@if ( \Auth::user()->role == 'admin' )
  <?php 
    $companyList = App\Company::where('status_id', 0)->orderBy( 'title' )->lists( 'title', 'id' );
    $companyList->prepend('None', 0);
  ?>
  {!! Form::label( 'company_id', 'Company') !!}
  {!! Form::select( 'company_id', $companyList, $user->company_id ) !!}

  {!! Form::label( 'role', 'Role') !!}
  {!! Form::select( 'role', App\Role::orderBy( 'title' )->lists( 'title', 'slug' ), $user->role ) !!}
  
  {!! Form::Label( 'user_status_id', 'Status' ) !!}
  {!! Form::select( 'user_status_id', App\UserStatus::orderBy( 'id' )->lists( 'title', 'id' ), $user->user_status_id ) !!}

@endif

{!! Form::submit('Submit') !!}

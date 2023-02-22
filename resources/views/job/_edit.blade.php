@if ( \Auth::check() )
  @if ( \Auth::user()->role == 'user' )
    {!! Form::hidden( 'company_id', \Auth::user()->company_id ) !!}
    <h4>Company</h4>
    <p>{{ \App\Company::find( \Auth::user()->company_id )->first()->title }}</p>
  @elseif  ( \Auth::user()->role == 'admin' )
    {!! Form::label( 'company_id', 'Company') !!}
    {!! Form::select( 'company_id', \App\Company::lists( 'title', 'id' )) !!}
  @else
    {!! Form::hidden( 'company_id', 0 ) !!}
  @endif
@else
  {!! Form::label('email', 'Submitter Email:'),"<span class='event-create'>(* required)</span>" !!}
  {!! Form::text( 'email' ) !!}
@endif

<h3>Job Info:</h3>
{!! Form::label( 'company_name', 'Company Name' ) !!}
{!! Form::text( 'company_name' ) !!}

{!! Form::label( 'job_type_id', 'Job Type' ) !!}
{!! Form::select( 'job_type_id', \App\JobType::lists( 'title', 'id' )) !!}

{!! Form::label( 'job_title', 'Job Title' ) !!}
{!! Form::text( 'job_title' ) !!}

<!-- {!! Form::label( 'location', 'Location' ) !!}
{!! Form::text( 'location' ) !!} -->

{!! Form::label( 'description', 'Job Description' ) !!}
{!! Form::textarea( 'description', null, ['class' => 'ckeditor'] ) !!}

<!-- {!! Form::label( 'contact_info' ) !!}
{!! Form::textarea( 'contact_info', null, ['class' => 'ckeditor'] ) !!} -->

{!! Form::label( 'company_url', 'Company Contact URL' ) !!}
{!! Form::text( 'company_url' ) !!}

@if ( \Auth::check() && \Auth::user()->role == 'admin' )
  {!! Form::label( 'status_id', 'Status') !!}
  {!! Form::select( 'status_id', \App\Status::lists( 'title', 'id' )) !!}
@endif

@if ( !\Auth::check() )
  <h3>Submitted by:</h3>
  {!! Form::label( 'first_name', 'First Name' ) !!}
  {!! Form::text( 'first_name' ) !!}

  {!! Form::label( 'last_name', 'Last Name' ) !!}
  {!! Form::text( 'last_name' ) !!}

  {!! Form::label( 'title', 'Title' ) !!}
  {!! Form::text( 'title' ) !!}

  {!! Form::label( 'company_name_sub', 'Company Name' ) !!}
  {!! Form::text( 'company_name_sub' ) !!}

  {!! Form::label( 'phone', 'Phone Number' ) !!}
  {!! Form::text( 'phone' ) !!}

  {!! Form::label( 'contact_email', 'Email' ) !!}
  {!! Form::text( 'contact_email' ) !!}

  {!! Form::checkbox('agree', 'agree') !!} I have read the <a href='/content/terms-of-use' target='_blank'>Terms of Use</a>
@endif

{!! Form::submit( 'Submit', array('class'=>'btn btn-large btn-primary btn-block' )) !!}

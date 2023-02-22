<div class="form-element">
  {!! Form::label( 'title', 'Company' ) !!}
  {!! Form::text( 'title' ) !!}
</div>
<div class="form-element">
  {!! Form::label( 'image', 'Company Logo' ) !!}
  @if ( isset( $company->image ) && strlen( $company->image ) > 0 )
      <div class="company-image"><img src="/data/companies/img/{{ $company->image }}"></div>
  @endif
  <p>Current Image : {!! isset( $company->image ) ? $company->image : 'None' !!}</p>
  {!! form::checkbox( 'image_delete', 'image_delete', false) !!} Delete Document? {!! Form::file('image', null) !!}
</div>

@if ( \Auth::user()->role == 'admin' )
  <div class="form-element">
    {!! Form::Label( 'status_id', 'Overall Status (Admin)' ) !!} 
    {!! Form::select( 'status_id', \App\Status::orderBy( 'id' )->pluck( 'title', 'id' ), isset( $company->status_id ) ? $company->status_id : '' ) !!}
  </div>
@endif

{!! Form::submit( 'Submit', array('class'=>'btn btn-large btn-primary btn-block' )) !!}

<style>
	.company-image img {
		max-width: 35%;
	}
</style>

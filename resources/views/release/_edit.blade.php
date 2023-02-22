@if ( \Auth::check() )
  @if ( \Auth::user()->role == 'admin' )
    <div class="form-element">
      {!! Form::label( 'company_id', 'Company' ) !!}
      {!! Form::select( 'company_id', \App\Company::orderBy( 'id' )->pluck( 'title', 'id' ), isset( $release->company_id ) ? $release->company_id : \Auth::user()->company_id ) !!}
    </div>
  @else
    {!! Form::hidden( 'company_id', isset( $release->company_id ) ? $release->company_id : \Auth::user()->company_id ) !!}
  @endif
@else
 {!! Form::hidden( 'status_id', 0 ) !!}
@endif

<div class="form-element">
  {!! Form::Label( 'release_type_id', 'ReleaseType' ) !!} 
  {!! Form::select( 'release_type_id', \App\ReleaseType::orderBy( 'id' )->pluck( 'title', 'id' ), isset( $release->release_type_id ) ? $release->release_type_id : '' ) !!}
</div>

<div class="form-element">
  {!! Form::label( 'pub_date', 'Publication Date' ) !!}
  {!! Form::date( 'pub_date', isset( $release->pub_date ) ? $release->pub_date : \Carbon\Carbon::now() ) !!}
</div>

<div class="form-element">
  {!! Form::label( 'title', 'News Headline' ) !!}
  {!! Form::text( 'title' ) !!}
</div>

<div class="form-element">
  {!! Form::label( 'body', 'Business Brief' ) !!} 
  {!! Form::textarea( 'body', null, array('maxlength' => 1525) ) !!}
</div>

<div class="form-element">
  {!! Form::label( 'image', 'Image' ) !!}
  @if ( isset( $release->image ) && strlen( $release->image ) > 0 )
      <div class="release-image"><img src="/data/releases/img/{{ $release->image }}"></div>
  @endif
  <p>Current Image : {!! isset( $release->image ) ? $release->image : 'None' !!}</p>
  {!! form::checkbox( 'image_delete', 'image_delete', false) !!} Delete Document? {!! Form::file('image', null) !!}
</div>

<!-- <div class="form-element">
  {!! Form::label( 'video', 'Video' ) !!} 
  {!! Form::textarea( 'video' ) !!}
</div> -->

<div class="form-element">
  {!! Form::label( 'keywords', 'Keywords' ) !!}
  {!! Form::text( 'keywords', null, [ 'maxlength' => '100' ] ) !!}
</div>

@if ( \Auth::check() && \Auth::user()->role == 'admin' )
  <div class="form-element">
    {!! Form::Label( 'status_id', 'Status' ) !!} 
    {!! Form::select( 'status_id', \App\Status::orderBy( 'id' )->pluck( 'title', 'id' ), isset( $release->status_id ) ? $release->status_id : 0 ) !!}
  </div>
@endif

@if ( !\Auth::check() )
  <h3>Submitted by:</h3>
  {!! Form::label( 'first_name', 'First Name' ) !!}
  {!! Form::text( 'first_name' ) !!}

  {!! Form::label( 'last_name', 'Last Name' ) !!}
  {!! Form::text( 'last_name' ) !!}

  {!! Form::label( 'contact_title', 'Title' ) !!}
  {!! Form::text( 'contact_title' ) !!}

  {!! Form::label( 'company_name_sub', 'Company Name' ) !!}
  {!! Form::text( 'company_name_sub' ) !!}

  {!! Form::label( 'phone', 'Phone Number' ) !!}
  {!! Form::text( 'phone' ) !!}

  {!! Form::label( 'contact_email', 'Email' ) !!}
  {!! Form::text( 'email' ) !!}

  {!! Form::checkbox('agree', 'agree') !!} I have read the <a href='/content/terms-of-use' target='_blank'>Terms of Use</a>
@endif

<div class="form-actions">
  {!! Form::submit( 'Submit', array('class'=>'btn btn-large btn-primary btn-block' )) !!}
</div>

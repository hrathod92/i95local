<?php 
    if(Auth::user()->role == 'agency'){
        $companies = \App\Company::where('id', $author->company_id)->lists( 'title', 'id' );
        $companyName =  \App\Company::find($author->company_id);
    }elseif(Auth::user()->role == 'admin'){
        $companies = \App\Company::where('status_id', 0)->lists( 'title', 'id' );
        $companyName = \App\Company::find(51);
    }else{
        $companyName = \App\Company::find( Auth::user()->company_id);
        $companies = \App\Company::where('id', Auth::user()->company_id)->lists( 'title', 'id' );
    }
?>

{!! Form::hidden('company_id', $companyName->id) !!}

{!! Form::label( 'title', 'Title' ) !!}
{!! Form::text( 'title' ) !!}

{!! Form::label( 'body', 'Description' ) !!}
{!! Form::textarea( 'body' ) !!}

<div class="form-element">
  {!! Form::Label( 'company_id', 'Company' ) !!}
  {!! Form::select( 'company_id', $companies, isset( $author) ? $author->company_id : '' ) !!}
</div>

<div class="form-element">
  {!! Form::label( 'image', 'Image' ) !!}
  @if ( !empty( $author->image ))
    <img src="/data/authors/img/{{ $author->image }}?ut={{ str_replace( ' ', '-', $author->updated_at ) }}">
  @endif
  <p>Current Image : {!! isset( $author->image ) ? $author->image : 'None' !!}</p>
  {!! form::checkbox( 'image_delete', 'image_delete', false) !!} Delete Image? {!! Form::file('image', null) !!}
</div>

{!! Form::submit( 'Submit', array('class'=>'btn btn-large btn-primary btn-block' )) !!}

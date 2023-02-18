<?php $companyName = \App\Company::find( $id); ?>
{!! Form::hidden('company_id', $id) !!}

{!! Form::label( 'title', 'Title' ) !!}
{!! Form::text( 'title' ) !!}

{!! Form::label( 'body', 'Description' ) !!}
{!! Form::textarea( 'body' ) !!}

<div class="form-element">
  {!! Form::Label( 'company_id', 'Company' ) !!}
  {!! Form::text( 'company', $companyName->title, ['readonly'] ) !!}
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

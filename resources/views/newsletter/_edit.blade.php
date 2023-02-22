<div class="form-element">
  {!! Form::label( 'title', 'Title (YYYY-MM)' ) !!}
  {!! Form::text( 'title' ) !!}
</div>

<div class="form-element">
  {!! Form::label( 'body', 'Description' ) !!}
  {!! Form::textarea( 'body' ) !!}
</div>

<?php $yearSelect = \App\NewsletterYear::where( 'title', '<=', date( 'Y', strtotime( '+1 year' )))->orderBy( 'title', 'DESC')->pluck( 'title', 'title' ); ?>
<div class="form-element">
  {!! Form::Label( 'newsletter_year', 'Newsletter Year' ) !!}
  {!! Form::select( 'newsletter_year', $yearSelect, isset( $newsletter->newsletter_year ) ? $newsletter->newsletter_year : date( 'Y' ) ) !!}
</div>

<div class="form-element">
  {!! Form::label( 'image', 'Cover Image' ) !!}
  <p>Current Image : {!! isset( $newsletter->image ) ? $newsletter->image : 'None' !!}</p>
  {!! form::checkbox( 'image_delete', 'image_delete', false ) !!} Delete Image?
  {!! Form::file( 'image', null ) !!}
</div>

<div class="form-element">
  {!! Form::label( 'document', 'Document' ) !!}
  <p>Current Image : {!! isset( $newsletter->document ) ? $newsletter->document : 'None' !!}</p>
  {!! form::checkbox( 'document_delete', 'document_delete', false ) !!} Delete Document?
  {!! Form::file( 'document', null ) !!}
</div>

<div class="form-element">
  {!! Form::Label( 'status_id', 'Status' ) !!}
  {!! Form::select( 'status_id', \App\Status::orderBy( 'id' )->pluck( 'title', 'id' ), isset( $newsletter->status_id ) ? $newsletter->status_id : '' ) !!}
</div>

<div class="form-actions">
  {!! Form::submit( 'Submit', array('class'=>'btn btn-large btn-primary btn-block' )) !!}
</div>

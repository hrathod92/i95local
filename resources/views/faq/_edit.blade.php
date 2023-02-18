{!! Form::label( 'refno', 'Reference Number' ) !!}
{!! Form::text( 'refno' ) !!}

{!! Form::label( 'title', 'Title' ) !!}
{!! Form::text( 'title' ) !!}

{!! Form::label( 'body', 'Description' ) !!}
{!! Form::textarea( 'body' ) !!}

<?php $typeSelect = [ 'guest' => 'Guest', 'user' => 'User', 'admin' => 'Admin' ]; ?>
{!! Form::Label( 'type', 'Type' ) !!} 
{!! Form::select( 'type', $typeSelect, isset( $faq->type ) ? $faq->type : 'guest' ) !!}

{!! Form::Label( 'status_id', 'Overall Status (Admin)' ) !!} 
{!! Form::select( 'status_id', \App\Status::orderBy( 'id' )->lists( 'title', 'id' ), isset( $faq->status_id ) ? $faq->status_id : '' ) !!}

{!! Form::submit( 'Submit', array('class'=>'btn btn-large btn-primary btn-block' )) !!}

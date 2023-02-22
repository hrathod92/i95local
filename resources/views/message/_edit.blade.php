{!! Form::label( 'title', 'Title' ) !!}
{!! Form::text( 'title' ) !!}

<div class="form-element">
  {!! Form::Label( 'message_type_id', 'Message Type' ) !!} 
  {!! Form::select( 'message_type_id', \App\MessageType::orderBy( 'id' )->pluck( 'title', 'id' ), isset( $message->message_type_id ) ? $message->message_type_id : '' ) !!}
</div>

<div class="form-element">
  {!! Form::Label( 'user_id', 'User' ) !!} 
  {!! Form::select( 'user_id', \App\User::orderBy( 'id' )->pluck( 'title', 'id' )->prepend( 'All', 0 ), isset( $message->user_id ) ? $message->user_id : '' ) !!}
</div>

{!! Form::label( 'body', 'Message' ) !!}
{!! Form::textarea( 'body' ) !!}

{!! Form::submit( 'Submit', array('class'=>'btn btn-large btn-primary btn-block' )) !!}

{!! Form::label( 'title', 'Title' ) !!}
{!! Form::text( 'title' ) !!}

{!! Form::label( 'body', 'Description' ) !!}
{!! Form::textarea( 'body' ) !!}

{!! Form::label( 'status', 'Status' ) !!}
{!! Form::select( 'status', [App\Order::$STATUS_PENDING => App\Order::$STATUS_PENDING,
                             App\Order::$STATUS_ACTIVE => App\Order::$STATUS_ACTIVE,
                             App\Order::$STATUS_FINISHED => App\Order::$STATUS_FINISHED,
                             App\Order::$STATUS_FAILED => App\Order::$STATUS_FAILED
                             ] ) !!}

{!! Form::submit( 'Submit', array('class'=>'btn btn-large btn-primary btn-block' )) !!}

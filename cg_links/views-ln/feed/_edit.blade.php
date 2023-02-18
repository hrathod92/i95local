{!! Form::label( 'title', 'Title' ) !!}
{!! Form::text( 'title' ) !!}

{!! Form::label( 'body', 'Description' ) !!}
{!! Form::textarea( 'body' , null, ['class' => 'ckeditor']) !!}

{!! Form::label( 'embed', 'URL' ) !!}
{!! Form::textarea( 'embed' ) !!}

{!! Form::submit( 'Submit', array('class'=>'btn btn-large btn-primary btn-block' )) !!}

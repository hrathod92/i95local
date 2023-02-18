{!! Form::label( 'type', 'Type' ) !!}
{!! Form::text( 'type' ) !!}

{!! Form::label( 'slug', 'Slug' ) !!}
{!! Form::text( 'slug' ) !!}

{!! Form::label( 'title', 'Title' ) !!}
{!! Form::text( 'title' ) !!}

{!! Form::label( 'body', 'Description' ) !!}
{!! Form::textarea( 'body' ) !!}

{!! Form::submit( 'Submit', array('class'=>'btn btn-large btn-primary btn-block' )) !!}

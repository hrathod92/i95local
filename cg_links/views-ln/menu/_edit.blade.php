{!! Form::label( 'title', 'Title' ) !!}
{!! Form::text( 'title' ) !!}

{!! Form::label( 'slug', 'Slug' ) !!}
{!! Form::text( 'slug' ) !!}

{!! Form::label( 'body', 'Body' ) !!}
{!! Form::textarea( 'body' ) !!}

{!! Form::submit( 'Submit', array('class'=>'btn btn-large btn-primary btn-block' )) !!}

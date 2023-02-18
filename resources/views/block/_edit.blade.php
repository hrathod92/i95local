{!! Form::label( 'type', 'Type' ) !!}
{!! Form::text( 'type' ) !!}

{!! Form::label( 'slug', 'Slug' ) !!}
{!! Form::text( 'slug' ) !!}

{!! Form::label( 'class', 'Class' ) !!}
{!! Form::text( 'class' ) !!}

{!! Form::label( 'title', 'Title' ) !!}
{!! Form::text( 'title' ) !!}

{!! Form::label( 'body', 'Description' ) !!}
{!! Form::textarea( 'body', isset($block)?$block->body:null, ['class' => 'ckeditor'] ) !!}

{!! Form::submit( 'Submit', array('class'=>'btn btn-large btn-primary btn-block' )) !!}

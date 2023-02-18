{!! Form::label( 'title', 'Title' ) !!}
{!! Form::text( 'title' ) !!}

{!! Form::label( 'uploadfile', 'Image') !!}
{!! Form::file('uploadfile') !!}

{!! Form::label( 'caption', 'Caption' ) !!}
{!! Form::textarea( 'caption', (isset($slider))?$slider->caption:null, ['class' => 'ckeditor'] ) !!}

{!! Form::label( 'url', 'Url' ) !!}
{!! Form::text( 'url' ) !!}

{!! Form::label( 'button_text', 'Button Text' ) !!}
{!! Form::text( 'button_text' ) !!}

{!! Form::submit( 'Submit', array('class'=>'btn btn-large btn-primary btn-block' )) !!}

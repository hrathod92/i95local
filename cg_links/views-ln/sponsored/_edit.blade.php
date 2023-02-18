{!! Form::label( 'title', 'Title' ) !!}
{!! Form::text( 'title' ) !!}

<div class="form-element">
  {!! Form::label( 'image', 'Image' ) !!}
  <p>Current Image : {!! isset( $sponsored->image ) ? $sponsored->image : 'None' !!}</p>
  {!! form::checkbox( 'image_delete', 'image_delete', false) !!} Delete Document? {!! Form::file('image', null) !!}
</div>

{!! Form::label( 'body', 'Description' ) !!}
{!! Form::textarea( 'body' ) !!}

{!! Form::label( 'url', 'URL' ) !!}
{!! Form::text( 'url' ) !!}

{!! Form::submit( 'Submit', array('class'=>'btn btn-large btn-primary btn-block' )) !!}

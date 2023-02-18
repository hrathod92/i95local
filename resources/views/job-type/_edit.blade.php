<?php
$key = 'title';
?>
{!! Form::label($key) !!}
{!! Form::text($key) !!}

{!! Form::submit( 'Submit', array('class'=>'btn btn-large btn-primary btn-block' )) !!}

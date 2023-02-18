<?php $page['title'] = 'Upload - Select'; ?>
<?php $page['breadcrumb'] = '<a href="/">home</a> &gt; upload &gt; select'; ?>
<?php $page['css'] = 'upload-select'; ?>

@extends( 'templates.default' )
@section( 'content' )
   
	{{ Form::open( array( 'url' => 'upload', 'files' => true )) }}

		{{ Form::label( 'file', 'File', array('id'=>'', 'class'=>'' )) }}
		{{ Form::file( 'file', '', array('id'=>'', 'class'=>'' )) }}

		{{ Form::submit('Save') }}
		{{ Form::reset('Reset') }}

	{{ Form::close() }}

	<div class='app-debug'>
		Debug: User ID: {{ Auth::user()->id }}
	</div>
    
@stop
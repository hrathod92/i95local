<?php 
  $page['title'] = 'Author - Create';
  $page['css'] = 'authors'; 
?>

@extends( 'templates.default' )
@section( 'content' )

{!! Form::model( new App\Author, [ 'route' => [ 'authors.store' ], 'class'=>'', "files" => true ]) !!}
  @include( 'author._edit' )
{!! Form::close() !!}

@stop

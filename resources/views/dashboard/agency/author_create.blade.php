<?php 
  $page['title'] = 'Author - Create';
  $page['css'] = 'authors'; 
?>

@extends( 'templates.default' )
@section( 'content' )

{!! Form::model( new App\Author, [ 'method' => 'PATCH','route' => [ 'agency.author.store', $id ], 'class'=>'', "files" => true ]) !!}
  @include( 'agency.author._edit' )
{!! Form::close() !!}

@stop

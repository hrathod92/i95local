<?php $page['title'] = 'Block - Edit'; ?>
<?php $page['css'] = 'block-edit'; ?>

@extends( 'templates.default' )
@section( 'content' )

{!! Form::model( $block, [ 'method' => 'PATCH', 'route' => [ 'blocks.update', $block->id ], 'files' => true ]) !!}
  @include( 'block._edit' )
{!! Form::close() !!}   

@stop

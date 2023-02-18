<?php $page['title'] = 'Block - Create'; ?>
<?php $page['css'] = 'block-create'; ?>

@extends( 'templates.default' )
@section( 'content' )

{!! Form::model( new App\Block, ['route' => [ 'blocks.store' ], 'class'=>'', 'files' => true ]) !!}
    @include( 'block._edit' )
{!! Form::close() !!}

@stop
<?php $page['title'] = 'Update User'; ?>
<?php if ( Auth::user()->roles == 'admin' ) $page['sideblocks'] = array( 'dashboard._sidebar' ); ?>
<?php $page['css'] = 'dashboard'; ?>

@extends( 'templates.default' )
@section( 'content' )

{!! Form::model( $user, array( 'route' => array( 'user.edit', $user->id ))) !!}
	{!! Form::hidden( 'id' ) !!}
	@include( 'user._edit' )
{!! Form::close() !!}


@stop
<?php $page['title'] = 'Job - Edit'; ?>
<?php $page['css'] = 'job-edit'; ?>

@extends( 'templates.default' )
@section( 'content' )

{!! Form::model( $item, [ 'method' => 'PATCH', 'route' => [ 'jobs.update', $item->id ]]) !!}
    @include( 'job._edit' )
{!! Form::close() !!}

@stop

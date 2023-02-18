<?php $page['title'] = 'Job - Create'; ?>
<?php $page['css'] = 'job-create'; ?>

@extends( 'templates.default' )
@section( 'content' )

{!! Form::model( new App\Job, ['route' => [ 'jobs.store' ], 'class'=>'' ]) !!}

    @include( 'job._edit' )
    
{!! Form::close() !!}

@stop
<?php $page['title'] = 'Campaign - Edit'; ?>
<?php $page['css'] = 'campaign-edit'; ?>

@extends( 'templates.default' )
@section( 'content' )

{!! Form::model( $campaign, [ 'method' => 'PATCH', 'route' => [ 'campaigns.update', $campaign->id ]]) !!}

    @include( 'campaign._edit' )
    
{!! Form::close() !!}

@stop

<?php $page['title'] = 'Profile - Edit'; ?>
<?php $page['css'] = 'profile-edit'; ?>

@extends( 'templates.default' )
@section( 'content' )

{!! Form::model( $profile, [ 'method' => 'PATCH', 'route' => [ 'profiles.update', $profile->id ]]) !!}

    @include( 'profile._edit' )
    
{!! Form::close() !!}

@stop

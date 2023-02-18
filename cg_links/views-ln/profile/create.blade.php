<?php $page['title'] = 'Profile - Create'; ?>
<?php $page['css'] = 'profile-create'; ?>

@extends( 'templates.default' )
@section( 'content' )

{!! Form::model( new App\Profile, ['route' => [ 'profiles.store' ], 'class'=>'' ]) !!}

    @include( 'profile._edit' )
    
{!! Form::close() !!}

@stop
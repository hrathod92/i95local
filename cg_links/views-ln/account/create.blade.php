<?php $page['title'] = 'Account - Create'; ?>
<?php $page['css'] = 'account-create'; ?>

@extends( 'templates.default' )
@section( 'content' )

{!! Form::model( new App\Account, ['route' => [ 'accounts.store' ], 'class'=>'' ]) !!}

    @include( 'account._edit' )
    
{!! Form::close() !!}

@stop
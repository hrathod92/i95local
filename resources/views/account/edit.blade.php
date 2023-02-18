<?php $page['title'] = 'Account - Edit'; ?>
<?php $page['css'] = 'account-edit'; ?>

@extends( 'templates.default' )
@section( 'content' )

{!! Form::model( $account, [ 'method' => 'PATCH', 'route' => [ 'accounts.update', $account->id ]]) !!}

    @include( 'account._edit' )
    
{!! Form::close() !!}

@stop

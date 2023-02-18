<?php $page['title'] = 'Setting - Edit'; ?>
<?php $page['css'] = 'setting-edit'; ?>

@extends( 'templates.default' )
@section( 'content' )

{!! Form::model( $setting, [ 'method' => 'PATCH', 'route' => [ 'settings.update', $setting->id ]]) !!}

    @include( 'setting._edit' )
    
{!! Form::close() !!}

@stop

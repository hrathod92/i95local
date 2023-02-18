<?php $page['title'] = 'Registration Confirmation'; ?>
<?php $page['css'] = 'dashboard'; ?>

@extends( 'templates.default' )
@section( 'content' )

<h3 class="not-bold margin-bottom-2x">Welcome {{ $first_name }}, your registration has been completed.</p>

<p><a href='/user/login'>Click here</a> to login.</p>

@stop
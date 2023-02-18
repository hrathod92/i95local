<?php $page['title'] = 'Registration Confirmation'; ?>
<?php if ( Auth::check() && Auth::user()->role == 'admin' ) $page['sideblocks'] = [ 'dashboard._block_admin' ]; ?>
<?php $page['css'] = 'dashboard'; ?>

@extends( 'templates.default' )
@section( 'content' )

<p>An email has been sent to {{ session('email_msg') }} with a confirmation code/link.</p>

@stop
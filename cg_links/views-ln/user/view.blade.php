<?php $page['title'] = 'View Profile'; ?>
<?php if ( Auth::user()->roles == 'admin' ) $page['sideblocks'] = array( 'dashboard._sidebar' ); ?>
<?php $page['css'] = 'dashboard'; ?>

@extends( 'templates.default' )
@section( 'content' )

<div class="content-view-wrapper">
<div><strong>First Name:</strong> {{ $first_name }}</div>
<div><strong>Last Name:</strong> {{ $last_name }}</div>
<div><strong>Email:</strong> {{ $email }}</div>
<div><strong>Role:</strong> {{ $role }}</div>

@if ( Auth::user()->roles == 'admin' )
  <div><strong>Role:</strong> {{ $role }}</div>
  <div><strong>Status:</strong> {{ $user_status['title'] }}</div>
@endif

</div>

<div class="actions bottom"><a href="/user/edit/{{ $id }}" class='button small'>Edit</a></div>

@stop

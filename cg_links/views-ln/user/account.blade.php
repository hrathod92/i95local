<?php $page['title'] = 'My Account (Profile)'; ?>
<?php $page['sideblocks'] = array( 'ad._block_ads_side' ); ?>
<?php $page['css'] = 'dashboard'; ?>

@extends( 'templates.default' )
@section( 'content' )

<div class="user-wrapper">
  
  <div class="name"><strong>Name:</strong> {{ $first_name }} {{ $last_name }}</div>
  <div class="email"><strong>Email:</strong> {{ $email }}</div>
  <div class="phone"><strong>Phone:</strong> {{ $phone }}</div>
  <div class="role"><strong>Role:</strong> {{ ucfirst( $role ) }}</div>
  
  @if ( !empty( $param_array ))
    <table>
      <tr><th>Param</th><th>Value</th></tr>
      @foreach ( $param_array AS $key => $value )
        <tr><td>{{ $key }}</td><td>{{ $value }}</td></tr>
      @endforeach
    </table>
  @endif
  
  @if ( Auth::user()->roles == 'admin' )
    <div class="role"><strong>Role:</strong> {{ $role }}</div>
    <div class="status"><strong>Status:</strong> {{ $user_status['title'] }}</div>
  @endif
  
</div>

@include( 'ad._block_ads_info' )

<div class="actions bottom"><a class="button small" href="/user/edit/{{ $id }}" class='button'>edit</a></div>

@stop

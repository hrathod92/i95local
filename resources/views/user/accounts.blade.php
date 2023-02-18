<?php
    $page['title'] = 'Available Accounts';
    $page['sideblocks'] = [ 'dashboard._block_admin' ];
    $page['css'] = 'dashboard';
?>

@extends( 'templates.default' )
@section( 'content' )



<table>
  <thead>
    <tr>
      <th>Account</th>
      <th>City</th>
      <th>State</th>
      <th>Zip</th>
      <th></th>
    </tr> 
  </thead>
  <tbody>
    @foreach($accounts as $account)
        {!! Form::open(['url' => '/user-accounts/add']) !!}
            <tr>
                <td data-label="Account">{{$account->title}}</td>
                <td class="nowrap" data-label="City">{{$account->city}}</td>
                <td class="nowrap" data-label="State">@if($account->state != ''){{\App\State::find($account->state)->name}}@endif</td>
                <td class="nowrap" data-label="Zip">{{$account->zip_code}}</td>
                <td class="align-center nowrap">
                    {!! Form::submit( 'Add to User', array('class'=>'btn btn-large btn-primary btn-block small' )) !!}
                    {!! Form::hidden('user_id', $user->id) !!}
                    {!! Form::hidden('account_id', $account->id) !!}
                </td>
            </tr>
        {!! Form::close() !!}
    @endforeach
  </tbody>
</table>

@stop

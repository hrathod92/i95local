<?php $page['title'] = 'Pending Registrations'; ?>
<?php $page['sideblocks'] = array( 'dashboard._block_admin' ); ?>
<?php $page['css'] = 'dashboard'; ?>

@extends( 'templates.default' )
@section( 'content' )

@if( Session::has( 'message' ))
    <div class="message">{{ Session::get( 'message' ) }}</div>
@endif
<table>
  <thead>
	<tr>
		<th>Last Name</th>
		<th>First Name</th>
		<th>Email</th>
		<th class="align-center">Role</th>
		<th class="align-center">Action</th>
	</tr>
  </thead>
  <tbody>
	@foreach ( $registrations AS $user )
		<tr>
			<td data-label="Last Name"><a href="/user/view/{{ $user['id'] }}">{{ $user['last_name'] }}</a></td>
			<td data-label="First Name"><a href="/user/view/{{ $user['id'] }}">{{ $user['first_name'] }}</a></td>
			<td data-label="Email"><a href="mailto:{{ $user['email'] }}">{{ $user['email'] }}</a></td>
			<td class="align-center nowrap" data-label="Role">{{ $user->role }}</td>
			<td class="align-center nowrap" data-label="Actions">
				{!! Form::open(['url' => '/send-registration-email']) !!}
    
                {!! Form::hidden('id', $user->id) !!}
                
                {!! Form::submit( 'Send Email', array('class'=>'btn small btn-large btn-primary btn-block' )) !!}

                {!! Form::close() !!}
			</td>
		</tr>
	@endforeach
  </tbody>
</table>



@stop

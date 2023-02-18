<?php $page['title'] = 'Users'; ?>
<?php $page['sideblocks'] = array( 'user._block_admin','user._block_index' ); ?>
<?php $page['css'] = 'users'; ?>

@extends( 'templates.default' )
@section( 'content' )

<div class='content-actions'>
	<a class='button small icon-left' href="/user/create"><i class="fa fa-plus"></i>Create New User</a>
</div>

<table>
  <thead>
	<tr>
		<th class="align-center">Name</th>
		<th class="align-center">Company</th>
		<th class="align-center">Role</th>
		<th class="align-center">Status</th>
		<th class="align-center">Action</th>
	</tr>
  </thead>
  <tbody>
	@foreach ( $users AS $user )
		<tr>
			<td data-label="Last Name"><a href="/user/view/{{ $user['id'] }}">{{ $user['last_name'] }}, {{ $user['first_name'] }}</a></td>
			<td data-label="Company"><a href="/companies/{{ $user->company_id }}">{{ $user->company['title'] }}</a></td>
			<td class="align-center nowrap" data-label="Role">{{ $user->role }}</td>
			<td class="align-center nowrap" data-label="Status">{{ $user->user_status['title'] }}</td>
			<td class="align-center nowrap" data-label="Actions">
				<a class='button small' href="/user/edit/{{ $user['id'] }}">edit</a>
				<a class='button small' href="/user/view/{{ $user['id'] }}">view</a>
			</td>
		</tr>
	@endforeach
  </tbody>
</table>

<style>
	.content-actions {
		margin-bottom: 0.75em;
		float: left;
	}
</style>

@stop

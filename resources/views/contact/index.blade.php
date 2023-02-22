<?php 	
	$page['title'] = 'Admin - Contacts';
	$page['css'] = 'dashboard'; 
  $page['sideblocks'] = [ 'dashboard._block_admin' ];
?>

@extends( 'templates.default' )
@section( 'content' )

@if( !empty($contacts) && count($contacts) > 0 )
	<table class="contacts">
	  <thead>
		<tr>
			<th>Name</th>
			<th>Email</th>
			<th>Created</th>
			<th>Status</th>
			<th></th>
		</tr>
	  </thead>
	  <tbody>
			@foreach( $contacts as $contact )
				<tr>
					<td data-label="Name">{{ $contact->name }} </td>
					<td data-label="Email"><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></td>
					<td class="nowrap" data-label="Created">{{ date( 'd-M-Y H:m', strtotime( $contact->created_at )) }} </td>
					<td>{{ \App\Status::find( $contact->status_id )->first()->title }}</td>
					<td class="align-center nowrap">
						<a class='button small' href="/contacts/{{ $contact->id }}">View</a>
						<a class='button small' href="/contacts/{{ $contact->id }}/edit">Edit</a>
					</td>
				</tr>
			@endforeach
	  </tbody>
	</table>
@else
	<p>No contact requests to show</p>
@endif

@stop

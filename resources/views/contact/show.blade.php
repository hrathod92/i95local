<?php 
  $page['title'] = 'Contact - ' . $contact->name;
  $page['sideblocks'] = [ 'dashboard._block_admin' ];
  $page['css'] = 'dashboard'; 
?>

@extends( 'templates.default' )
@section( 'content' )

<div class="contacts-wrapper">
  <div class="contact-title"><strong>Name:</strong> {{ $contact->name }}</div>
  <div class='contact-body'><strong>Email:</strong> {!! $contact->email !!}</div>
  <div class='contact-body'><strong>Phone:</strong> {!! $contact->phone !!}</div>
  <div class='contact-date'><strong>Date:</strong> {!! date( 'd-M-Y H:i', strtotime( $contact->created_at )) !!}</div>
  <div class='contact-body'><strong>Comments:</strong> {!! $contact->comments !!}</div>
  <div class='contact-body'><strong>Notes:</strong> {!! $contact->notes !!}</div>
  <div class='contact-body'><strong>Status:</strong> {!! $contact->status->title !!}</div>
</div>

<div class="actions bottom">
	<a class='button small' href='/contacts/{{ $contact->id }}/edit'>Edit</a>
	<a class='button small' href='/contacts'>Back to Contacts</a>
</div>

@stop
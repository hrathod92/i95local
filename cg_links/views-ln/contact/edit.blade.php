<?php $page['title'] = 'Contact - Edit'; ?>
<?php $page['css'] = 'dashboard'; 
if(\Auth::user()->role == 'admin')
    {
        $page['sideblocks'] = [ 'dashboard._block_admin' ];
    }
    else 
    {
        $page['sideblocks'] = [ 'dashboard._block_user' ];    
    }
?>

@extends( 'templates.default' )
@section( 'content' )

<div class="contacts-wrapper">
  <div class="contact-title"><strong>Name:</strong> {{ $contact->name }}</div>
  <div class='contact-body'><strong>Email:</strong> {!! $contact->email !!}</div>
  <div class='contact-body'><strong>Phone:</strong> {!! $contact->phone !!}</div>
  <div class='contact-date'><strong>Date:</strong> {!! date( 'd-M-Y H:i', strtotime( $contact->created_at )) !!}</div>
  <div class='contact-body'><strong>Comments:</strong> {!! $contact->comments !!}</div>
</div>

{!! Form::model( $contact, [ 'method' => 'PATCH', 'route' => [ 'contacts.update', $contact->id ]]) !!}
  <div class="form-element">
    {!! Form::Label('status_id', 'Status:') !!}
    {!! Form::select('status_id', App\Status::lists( 'title', 'id' ), $contact->status_id ) !!}
  </div>
  <div class="form-element">
    {!! Form::label( 'notes', 'Notes:' ) !!}
    {!! Form::textarea( 'notes' ) !!}
  </div>
  <div class="form-actions">
    {!! Form::submit( 'Submit', array('class'=>'btn btn-large btn-primary btn-block left-justify' )) !!}
  </div>
{!! Form::close() !!}

@stop

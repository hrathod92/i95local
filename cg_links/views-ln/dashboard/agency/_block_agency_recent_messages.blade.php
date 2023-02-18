<?php
  $messages = \App\Message::with( 'message_type', 'company' )
    ->whereIn('company_id',function($query){
       $query->select('company_id')->from('agency-company')->where('agency_id', auth()->user()->company_id);
    })
    ->orderBy( 'id', 'DESC' )
    ->take( 6 )
    ->get();
?>

<div class='dashboard-block dashboard-messages'>
  <h2>Recent Messages</h2>
  @if( count($messages) > 0 )
    @foreach ( $messages AS $message )
      <div class='search-message'>
        <div class="title" data-label="Title"><a href="/messages/{{ $message->id }}">{{ $message->message_type['title'] . ' : ' .$message->company['title'] . ' : ' . $message->title }}</a></div>
      </div>
    @endforeach
  @else
    <div class='dashboard-empty'>
      <div class="title" data-label="Title">No results found.</div>
        <br/>
    </div>
  @endif
  <div class='read-more'></div><a class='button small' href='/messages'>Read More</a>
</div>

<style>
  .dashboard-block {
    margin: 0 0 1em;
    padding: 1em;
    border: 1px solid #999;
  }

</style>


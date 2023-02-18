<?php
  $events = \App\Event::with('event_type')
    ->where( 'company_id', \Auth::user()->company_id )
    ->orderBy('id', 'DESC')
    ->take(3)
    ->get();
?>

<div class='dashboard-block dashboard-events'>
    <h2>Recent Events</h2>
    @if ( $events->count() )
        @foreach ( $events AS $event )
            <div class='search-event'>
                <div class="title" data-label="Title">
                    <a href="{{ route( 'events.show', $event->id ) }}">
                        @if($event->event_type)
                            {{$event->event_type->title}} :
                        @endif

                        {{$event->title}}
                    </a>
                </div>
            </div>
        @endforeach
    @else
        <div class='dashboard-empty'>
            <div class="title" data-label="Title">No results found.</div>
        </div>
    @endif
    <div class='read-more'></div><a class='button small' href="/events/company">Read More</a>
</div>

<?php
  $releases = \App\Release::with( 'release_type' )
    ->where( 'company_id', \Auth::user()->company_id )
    ->orderBy('id', 'DESC')
    ->take(3)
    ->get();
?>

<div class='dashboard-block dashboard-releases'>
    <h2>Recent Press Releases</h2>
    @if ( $releases->count() )
        @foreach ( $releases AS $release )
            <div class='search-article'>
                <div class="title" data-label="Title">
                    <a href="{{ route('releases.show', $release) }}">
                        @if( $release->release_type )
                            {{$release->release_type->title}} :
                        @endif
                        {{ $release->title }}
                    </a>
                </div>
            </div>
        @endforeach
    @else
        <div class='dashboard-empty'>
            <div class="title" data-label="Title">No results found.</div>
        </div>
    @endif
    <div class='read-more'></div><a class='button small' href="/releases/company">Read More</a>
</div>


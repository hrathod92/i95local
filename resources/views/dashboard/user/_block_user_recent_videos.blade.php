<?php
  $videos = \App\Video::with('video_type')
    ->where( 'company_id', \Auth::user()->company_id )
    ->orderBy('id', 'DESC')
    ->take(3)
    ->get();
?>

<div class='dashboard-block dashboard-videos'>
    <h2>Recent Videos</h2>
    @if ( $videos->count() )
        @foreach ( $videos AS $video )
            <div class='search-video'>
                <div class="title" data-label="Title">
                    <a href="{{ route( 'videos.show', $video->id ) }}">
                        @if($video->video_type)
                            {{ $video->video_type->title }} :
                        @endif
                        {{ $video->title }}
                    </a>
                </div>
            </div>
        @endforeach
    @else
        <div class='dashboard-empty'>
            <div class="title" data-label="Title">No search results found.</div>
        </div>
    @endif
    <div class='read-more'></div><a class='button small' href="/videos/company">Read More</a>
</div>

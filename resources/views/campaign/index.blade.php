<?php $page['title'] = 'Campaigns'; ?>
<?php $page['css'] = 'campaign-index'; ?>

@extends( 'templates.default' )
@section( 'content' )

<div class='campaigns'>
    @foreach ( $campaigns AS $campaign )
        <div class="campaign">
            <div class="campaign-title"><a href="/campaigns/{{ $campaign->id }}">{{ $campaign->title }}</a></div>
            <div class="campaign-description">{{ $campaign->body }}</div>
        </div>
    @endforeach
</div>

@stop

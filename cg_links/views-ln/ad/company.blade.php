<?php
  $title = 'Company Ads';
  $page['title']   = $title;
  $page['sideblocks'] = array( 'dashboard._block_user' );
  $page['css']     = 'dashboard';
?>

@extends( 'templates.default' )
@section( 'content' )

<table class='ads'>
    <thead>
    <tr>
        <th class="align-center">Type</th>
        <th class="align-center">Title</th>
        <th class="align-center">Starts</th>
        <th class="align-center">Ends</th>
        <th class="align-center">Publish</th>
        <th class="align-center">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach ( $items AS $ad )
        <tr>
            <td class="nowrap" data-label="Type"><a href="/ads/{{ $ad->slug }}">{{ $ad->ad_type['title'] }}</a></td>
            <td class="ad-title" data-label="Title"><a href="/ads/{{ $ad->slug }}">{{ $ad->title }}</a></td>
            <td>
                @if($ad->publish_start_at)
                    {{$ad->publish_start_at->format('m/d/Y')}}
                @endif
            </td>
            <td>
                @if($ad->publish_end_at)
                    {{$ad->publish_end_at->format('m/d/Y')}}
                @endif
            </td>
            <td class="ad-title" data-label="PublishStatus">
                @if( $ad->publishStatus )
                  <a href="/ads/{{ $ad->slug }}">{{ $ad->publish_status->title }}</a>
                @endif
            </td>
            <td class="nowrap align-center" data-label="Actions">
                <a class='button small' href='/ads/{{ $ad->slug }}'>view</a>
                <a class='button small' href='/ads/{{ $ad->slug }}/edit'>edit</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

@stop

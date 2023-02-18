<?php 
    $page['title'] = 'Ads';
    $page['sideads'] = array( 'dashboard._block_admin' );
    $page['css'] = 'dashboard';
?>

@extends( 'templates.default' )
@section( 'content' )

<p><a class='button small icon-left' href='/ads/create'><i class="fa fa-plus"></i>Create Ad</a></p>

<table class='ads'>
  <thead>
    <tr>
      <th class="align-center">Type</th>
      <th class="align-center">Slug</th>
      <th class="align-center">Title</th>
        <th class="align-center">Status</th>
      <th class="align-center">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach ( $ads AS $ad )
      <tr>
        <td class="nowrap" data-label="Type"><a href="/ads/{{ $ad->slug }}">{{ $ad->type }}</a></td>
        <td class="nowrap" data-label="Slug"><a href="/ads/{{ $ad->slug }}">{{ $ad->slug }}</a></td>
        <td class="ad-title" data-label="Title"><a href="/ads/{{ $ad->slug }}">{{ $ad->title }}</a></td>
          <td class="ad-title" data-label="Title"><a href="/ads/{{ $ad->slug }}">{{ $ad->status }}</a></td>

          <td class="nowrap align-center" data-label="Actions"><a class='button small' href='/ads/{{ $ad->slug }}/edit'>edit</a></td>
      </tr>
    @endforeach
  </tbody>
</table>

@stop

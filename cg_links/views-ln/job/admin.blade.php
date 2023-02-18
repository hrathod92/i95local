<?php
  use \App\Helpers\Display;
  $page['title'] = 'Admin - Jobs';
  $page['sideblocks'] = array( 'job._block_admin','dashboard._block_admin' );
  $page['css'] = 'dashboard';
?>

@extends( 'templates.default' )
@section( 'content' )

<p>
  <a class='button small icon-left' href='/jobs/create'><i class="fa fa-plus"></i>Create Job</a>
</p>

<table class='blocks'>
  <thead>
    <tr>
      <th class="align-center">Type</th>
      <th class="align-center">Company</th>
      <th class="align-center">Title</th>
      <th class="align-center">Date(s)</th>
      <th class="align-center">Status</th>
      <th class="align-center">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach ( $jobs as $item )
      <tr>
        <td>{{ $item->job_type['title'] }}</td>
        <td>{{ $item->company['title'] }}</td>
        <td class="block-title" data-label="Title"><a href="/jobs/{{ $item->id }}">{{ $item->job_title }}</a></td>
        <td class="align-center">{{ Display::dateStd( $item->created_at ) }}</td>
        <td class="align-center">{{ $item->status['title'] }}</td>
        <td class="action align-center nowrap">
          <a class='button small' href="/jobs/{{ $item->id }}">view</a>
          <a class='button small' href="/jobs/{{ $item->id }}/edit">edit</a>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

@stop

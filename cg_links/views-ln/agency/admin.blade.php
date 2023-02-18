<?php
  $page['title'] = 'Admin - ' . $status . ' Agencies';
  $page['sideblocks'] = array( 'dashboard._block_admin' );
  $page['css'] = 'dashboard';
?>

@extends( 'templates.default' )
@section( 'content' )

<p style="float: right">
  <a class='button small icon-left' href='/agency/admin'>Active Agencies</a>
  <a class='button small icon-left' href='/agency/admin/1'>Inactive Agencies</a>
</p>

<p>
  <a class='button small icon-left' href='/agency/create'><i class="fa fa-plus"></i>Create Agency</a>
</p>

<table class='blocks'>
  <thead>
    <tr>
      <th class="align-center">Title</th>
      <th class="align-center" colspan="3">Clients</th>
      <th class="align-center">Status</th>
      <th class="align-center">Action(s)</th>
    </tr>
  </thead>
  <tbody>
    @foreach ( $companies as $item )
      <?php $clients = \App\AgencyCompany::where('agency_id', $item->id)->get(); ?>
      <tr>
        <td class="block-title" data-label="Title"><a href="/agency/{{ $item->id }}/edit">{{ $item->title }}</a></td>
        <td class="block-type align-center" data-label="Clients" colspan="3">{{ \App\Helpers\Agency::getClientNames($item->id) }}</td>
        <td class="block-status align-center" data-label="Status">{{ $item->status['title'] }}</td>
        <td class="action align-center nowrap">
          <a class='button small' href="/agency/{{ $item->id }}">add/remove clients</a>
          <a class='button small' href="/agency/{{ $item->id }}/edit">edit</a>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

@stop

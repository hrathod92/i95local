<?php
  $page['title'] = 'Admin - ' . $status . ' Companies';
  $page['sideblocks'] = array( 'dashboard._block_admin' );
  $page['css'] = 'dashboard';
?>

@extends( 'templates.default' )
@section( 'content' )

<p style="float: right">
  <a class='button small icon-left' href='/companies/admin'>Active Companies</a>
  <a class='button small icon-left' href='/companies/admin/1'>Inactive Companies</a>
</p>

<p>
  <a class='button small icon-left' href='/companies/create'><i class="fa fa-plus"></i>Create Company</a>
</p>

<table class='blocks'>
  <thead>
    <tr>
      <th class="align-center">Title</th>
      <th class="align-center">Type</th>
      <th class="align-center">Weight</th>
      <th class="align-center">Image</th>
      <th class="align-center">Agency</th>
      <th class="align-center">Status</th>
      <th class="align-center">Action(s)</th>
    </tr>
  </thead>
  <tbody>
    @foreach ( $companies as $item )
      <?php 
        $hasAgency = \App\AgencyCompany::where('company_id', $item->id)->first();
        if(!empty($hasAgency)){
            $agency = \App\Company::where('id', $hasAgency->agency_id)->first();
        }else{
            $agency = null;
        }
      ?>
      <tr>
        <td class="block-title" data-label="Title"><a href="/companies/{{ $item->id }}">{{ $item->title }}</a></td>
        <td class="block-type align-center" data-label="Type">{{ $item->company_type['title'] }}</td>
        <td class="block-weight align-center" data-label="Weight">{{ $item->weight }}</td>
        <td class="block-image align-center" data-label="Image">{{ $item->image }}</td>
          <td class="block-image align-center" data-label="Agency">{{ !empty($agency) ? $agency->title : null }}</td>
        <td class="block-status align-center" data-label="Status">{{ $item->status['title'] }}</td>
        <td class="action align-center nowrap">
          <a class='button small' href="/companies/{{ $item->id }}">view</a>
          <a class='button small' href="/companies/{{ $item->id }}/edit">edit</a>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

@stop

<?php
    $allComp = \App\AgencyCompany::select('company_id')->get()->toArray();
    $avalableClients = \App\Company::whereNotIn('id', $allComp)->where('company_type_id','!=', 2)->where('status_id', 0)->orderBy('title')->get();
?>

<div class="block">
  <h3>Add Client</h3>
  <table class='blocks'>
      <thead>
        <tr>
          <th class="align-center">Title</th>
          <th class="align-center">Action(s)</th>
        </tr>
      </thead>
      <tbody>
        @foreach ( $avalableClients as $item )
          <tr>
            <td data-label="Title"><a href="/companies/{{ $item->id }}">{{ $item->title }}</a></td>
            <td class="action align-center nowrap">
              <a class='button small' href="/agency/add/{{ $item->id }}/{{ $id }}">add client</a>
            </td>
          </tr>
        @endforeach
      </tbody>
  </table>
</div>
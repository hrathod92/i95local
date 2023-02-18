<?php $clients = \App\Helpers\Agency::getClientList($id);?>
<br/>
<div class="block">
    <h3>Current Clients</h3>
    <table class='blocks'>
      <thead>
        <tr>
          <th class="align-center">Title</th>
          <th class="align-center">Action(s)</th>
        </tr>
      </thead>
      <tbody>
        @foreach ( $clients as $item )
          <tr>
            <td data-label="Title"><a href="/companies/{{ $item->id }}/edit">{{ $item->title }}</a></td>
            <td class="action align-center nowrap">
              <a class='button small' href="/agency/remove/{{ $item->id }}/{{ $id }}">remove client</a>
            </td>
          </tr>
        @endforeach
      </tbody>
  </table>
</div>

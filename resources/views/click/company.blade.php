<?php $page['title'] = "Analytics (Clicks) - " . $company_title; ?>
<?php $page['sideblocks'] = [ 'click._block_index' ]; ?>
<?php $page['css'] = 'click-index'; ?>

@extends( 'templates.default' )
@section( 'content' )

<table class='clicks'>
  <tr>
    <th class='align-center'>Company</th>
    <th class='align-center'>Type</th>
    <th class='align-center'>Item</th>
    <th class='align-center'>Views</th>
    <th class='align-center'>Action</th>
  </tr>
  @if ( $clicks->count() > 0 )
    @foreach ( $clicks AS $click )
      <tr class="click">
        <td class="click-company nowrap">{{ $click->company->title }}</td>
        <td class="align-center click-type">{{ $click->clickable_type }}</td>
        @if ( isset( $click->clickable ))
          <td class="click-item-id">
            @if ( $click->clickable_type != 'ad' )
              <a href='/{{ $click->clickable_type . "s/" . $click->clickable_id }}'>{{ $click->clickable->title }} ({{ $click->clickable_id }})</a>
            @else
              <a href='/{{ $click->clickable_type . "s/view/" . $click->clickable_id }}'>{{ $click->clickable->title }} ({{ $click->clickable_id }})</a>
            @endif
          </td>
        @else
          <td>---</td>
        @endif
        <td class="align-center click-click-count">{{ $click->click_count }}</td>
        @if ( isset( $click->clickable ))
          <td class="align-center click-view">
            @if ( $click->clickable_type != 'ad' )
              <a class='button small' href='/{{ $click->clickable_type . "s/" . $click->clickable_id }}'>View</a>
            @else
              <a class='button small' href='/{{ $click->clickable_type . "s/view/" . $click->clickable_id }}'>View</a>
            @endif
          </td>
        @else
          <td>({{ $click->clickable_type }} {{ $click->clickable_id }}</td>
        @endif
      </tr>
    @endforeach
  @else
    <tr><td colspan=10 class='align-center'>No analytics (click counts) for this company.</td></tr>
  @endif
</table>

@stop
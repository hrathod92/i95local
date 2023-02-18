<?php $page['title'] = 'Views by Type - ' . $type; ?>
<?php $page['sideblocks'] = [ 'click._block_index' ]; ?>
<?php $page['css'] = 'click-index'; ?>

@extends( 'templates.default' )
@section( 'content' )

<table class='clicks'>
  <tr>
    <th class='align-center'>Type</th>
    <th class='align-center'>Company</th>
    <th class='align-center'>Item</th>
    <th class='align-center'>Views</th>
    <th class='align-center'>Action(s)</th>
  </tr>
  @foreach ( $clicks AS $click )
    <tr class="click">
      <td class="click-type">{{ $click->clickable_type }}</td>
      <td class="click-item-id">{{ isset( $click->company->title ) ? $click->company->title : "---" }}</td>
      <td class="click-item-id">
        @if ( $click->clickable_type != 'ad' )
          <a href="/{{ $click->clickable_type }}s/{{ $click->clickable_id }}" title="edit" class="underline-link">
            {{ isset( $click->clickable ) ? $click->clickable->title : '---' }} 
            ({{ $click->clickable_id }})
          </a>
        @else
          <a href="/{{ $click->clickable_type }}s/view/{{ $click->clickable_id }}" title="edit" class="underline-link">
            {{ isset( $click->clickable ) ? $click->clickable->title : '---' }} 
            ({{ $click->clickable_id }})
          </a>
        @endif
      </td>
      <td class="click-click-count align-center">{{ $click->click_count }}</td>
      @if ( $click->clickable_type != 'ad' )
        <td class="align-center click-view"><a class='button small' href='/{{ $click->clickable_type . "s/" . $click->clickable_id }}'>View</a></td>
      @else
        <td class="align-center click-view"><a class='button small' href='/{{ $click->clickable_type . "s/view/" . $click->clickable_id }}'>View</a></td>
      @endif
    </tr>
  @endforeach
</table>

@stop

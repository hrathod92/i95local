<?php $page['title'] = 'Views'; ?>
<?php $page['sideblocks'] = [ 'click.admin._block_index_sidebar_filter','click._block_index' ]; ?>
<?php $page['css'] = 'click-index'; ?>



@extends( 'templates.default' )
@section( 'content' )

<table class='clicks'>
  <tr>
    <th class='align-center'>Company</th>
    <th class='align-center'>Type</th>
    <th class='align-center'>Item</th>
    <th class='align-center'>Views</th>
    <th class='align-center'>Action(s)</th>
  </tr>
  @foreach ( $clicks AS $click )
    <tr class="click">
      <td class="click-item-id">{{ !empty( $click->company ) ? $click->company->title : '---' }}</td>
      <td class="click-type nowrap">{{ $click->clickable_type }}</td>
      <td class="click-item-id">
        @if ( $click->clickable_type != 'ad' )
          <a href='/{{ $click->clickable_type . "s/" . $click->clickable_id }}'>
            {{ isset( $click->clickable->title ) ? $click->clickable->title : '' }} 
            ({{ $click->clickable_id }})
          </a>
        @else
          <a href='/{{ $click->clickable_type . "s/view/" . $click->clickable_id }}'>
            {{ isset( $click->clickable->title ) ? $click->clickable->title : '' }} 
            ({{ $click->clickable_id }})
          </a>
        @endif
      </td>
      <td class="click-click-count align-center">{{ $click->click_count }}</td>
      @if ( $click->clickable_type != 'ad' )
        <td class="click-click-count align-center"><a class='button small' href='/{{ $click->clickable_type }}s/{{ $click->clickable_id }}'>View</a></td>
      @else
        <td class="click-click-count align-center"><a class='button small' href='/{{ $click->clickable_type }}s/view/{{ $click->clickable_id }}'>View</a></td>
      @endif
    </tr>
  @endforeach
</table>

@stop

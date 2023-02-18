<?php $page['title'] = 'Ad - ' . $item->title; ?>
<?php $page['sideblocks'] = ['ad.show._block_show_sidebar']; ?>
<?php $page['css'] = 'dashboard'; ?>

@extends( 'templates.default' )
@section( 'content' )

<div class="content-view-wrapper">

  @if($item->image)
    <img src='/data/ads/img/{!! $item->image !!}'/>
  @endif

  <br /><br />

  <table class='ad-show-table'>

    <tr><td>Company</td><td>{!! $item->company['title'] !!}</td></tr>
    <tr><td>Type:</td><td>{!! $item->ad_type['title'] !!}</td></tr>
    <tr><td>Category</td><td>{!! isset( $item->category['title'] ) ? $item->category['title'] : '---' !!}</td></tr>
    <tr><td>Title:</td><td>{!! $item->title !!}</td></tr>
    <tr><td>Image ALT tag:</td><td>{!! $item->image_alt !!}</td></tr>
    <tr><td>Random Weight:</td><td>{!! $item->random_weight !!}</td></tr>
    <tr><td>Publish Start:</td><td>{{ isset($item->publish_start_at ) ? \App\Helpers\Display::dateStd( $item->publish_start_at ) : '---' }}</td></tr>
    <tr><td>Publish End:</td><td>{{ isset($item->publish_end_at) ? \App\Helpers\Display::dateStd( $item->publish_end_at ) : '---' }}</td></tr>
    <tr><td>Publish Status:</td><td>{{ isset( $item->publish_status ) ? $item->publishStatus->title : '---' }}</td></tr>
    <tr><td>Admin Status:</td><td>{{ isset( $item->status ) ? $item->status->title : '---' }}</td></tr>
    <tr><td>Notes:</td><td>{!! $item->body !!}</td></tr>

  </table>   
</div>

@if ( Auth::check() && in_array( Auth::user()->role, ['user', 'admin'] ))
  <div class="actions bottom">
    <a class="button small" href='/ads/{{ $item->slug }}/edit'>Edit</a>
  </div>
  <br />
@endif

@stop
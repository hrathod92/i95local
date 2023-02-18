<?php
  $title = 'Ads';
  $page['title'] = $title;
  $page['sideblocks'] = array( 'ad.index._block_index_sidebar_filter', 'ad.index._block_index_sidebar' );
  $page['css'] = 'dashboard';
?>

@extends( 'templates.default' )
@section( 'content' )

<p style="text-align:center; color:#06367d">
  <span class="pull-left"><a class='button small icon-left' href='/ads/create'><i class="fa fa-plus"></i>Create Ad</a></span>
  {!! $checked > 0 ? $checked.' Record(s) Deactivated' : '<br/>' !!}
</p>

<table class='ads'>
  
  <thead>
    <tr>
      <th class="align-center">Company</th>
      <th class="align-center">Title</th>
      <th class="align-center">Weight</th>
      <th class="align-center">Starts</th>
      <th class="align-center">Ends</th>
      <th class="align-center">Publish</th>
      <th class="align-center">Status</th>
      <th class="align-center">Action</th>
    </tr>
  </thead>
  
  <tbody>
    <?php $currentAdTypeID = -1;?>
    
    @foreach ( $items AS $ad )
    
      @if ( $currentAdTypeID != $ad->ad_type_id )
        <?php $currentAdTypeID = $ad->ad_type_id; ?>
        <tr><th class='ads-type-title' colspan=10><a href='/ads?ad_type_id={{ $currentAdTypeID }}'>{!! $ad->ad_type->title !!}</a></th></tr>
      @endif

      <tr>
        <td class="ad-title" data-label="Company"><a href='/ads?company_id={{ $ad->company_id }}'>{{ isset( $ad->company ) ? $ad->company->title : '---' }}</a></td>
        <td class="ad-title" data-label="Title"><a href="/ads/{{ $ad->slug }}">{{ $ad->title }}</a></td>
        <td class="ad-title align-center" data-label="Weight">{{ $ad->random_weight }}</td>
        <td class="ad-title align-center">{{ !empty($ad->publish_start_at) && $ad->publish_start_at->format('Y') != '-0001' ? $ad->publish_start_at->format('m/d/Y') : '---' }}</td>
        <td class="ad-title align-center">{{ !empty( $ad->publish_end_at ) && $ad->publish_start_at->format('Y') != '-0001' ? $ad->publish_end_at->format('m/d/Y') : '---' }}</td>
        <td class="ad-title align-center" data-label="PublishStatus">
          <a href="/ads/{{ $ad->slug }}">{{ isset($ad->publish_status_id) ? $ad->publishStatus->title : '---' }}</a>
        </td>
        <td class="ad-title align-center" data-label="Status">
          <a href="/ads/{{ $ad->slug }}">{{ isset( $ad->status ) ? $ad->status->title : '---' }}</a>
        </td>
        <td class="nowrap align-center" data-label="Actions">
          <a class='button small' href='/ads/{{ $ad->slug }}'>view</a>
          <a class='button small' href='/ads/{{ $ad->slug }}/edit'>edit</a>
        </td>
      </tr>
      <tr style="border-bottom: 4px solid #06367d;"><th class='ads-category' colspan=10>Category: {{ isset($ad->category->title) ? $ad->category->title : 'None' }}</th></tr>
    @endforeach
  </tbody>
  
</table>

<style>
  .ads .ads-type-title {
    background: #06367d;
  }
  .ads .ads-type-title a{
    color: #fff;
  }
  .ads .ads-category {
    background: #D6D6D6;
    color: #06367d;
  }
</style>
@stop
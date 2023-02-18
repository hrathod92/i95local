<?php 
    $page['title'] = 'Settings';
    $page['sideblocks'] = array( 'dashboard._block_admin');
    $page['css'] = 'dashboard';
?>

@extends( 'templates.default' )
@section( 'content' )

<p><a class='button small icon-left' href='/settings/create'><i class="fa fa-plus"></i>Create New Setting</a></p>

<table class='settings'>
  <thead>
  <tr>
    <th class="align-center">Type</th>
    <th>Title</th>
    <th class="align-center">Slug</th>
    <th class="align-center">Action</th>
  </tr>
  </thead>
  <tbody>
  @foreach ( $settings AS $setting )
    <tr class="setting">
        <td class="setting-type align-center nowrap" data-label="Type"><a href="/settings/{{ $setting->id }}">{{ $setting->type }}</a></td>
        <td class="setting-title" data-label="Title"><a href="/settings/{{ $setting->id }}">{{ $setting->title }}</a></td>
        <td class="setting-slug align-center nowrap" data-label="Slug"><a href="/settings/{{ $setting->id }}">{{ $setting->slug }}</a></td>
        <td class="align-center nowrap">
          <a class='button small' href='/settings/{{ $setting->id }}/edit'>edit</a>
        </td>
    </tr>
  @endforeach
  </tbody>
</table>

@stop

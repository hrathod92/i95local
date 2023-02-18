<?php 
    $page['title'] = 'Menus';
    $page['sideblocks'] = [ 'dashboard._block_admin' ];
    $page['css'] = 'dashboard';
?>

@extends( 'templates.default' )
@section( 'content' )

<div class='menus'>
  <table>
    <thead>
      <tr>
        <th>Title</th>
        <th class="align-center">Slug</th>
        <th class="align-center">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ( $menus AS $menu )
      <tr>
        <td class="title"><a href="/menus/{{ $menu->id }}">{{ $menu->title }}</a></td>
        <td class="slug align-center nowrap"><a href="/menus/{{ $menu->id }}">{{ $menu->slug }}</a></td>
        <td class="action align-center nowrap"><a class="button small" href="/menus/{{ $menu->id }}/edit">Edit</a></td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<p><a class="button small icon-left" href='/menus/create'><i class="fa fa-plus"></i>Create New Menu</a></p>

@stop

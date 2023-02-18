<?php 
    $page['title'] = 'Admin - Contents';
    $page['sideblocks'] = [ 'dashboard._block_admin' ];
    $page['css'] = 'dashboard'; 
?>

@extends( 'templates.default' )
@section( 'content' )

<p>
  <a class='button small icon-left' href='contents/create'><i class="fa fa-plus"></i>Create</a>
</p>

<div class='contents'>
  <table>
    <thead>
    <tr>
      <th>Title</th>
      <th class="align-center">Slug</th>
      <th class="align-center">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach ( $contents AS $content )
      <tr>
        <td class="title" data-label="Title"><a href="/contents/{{ $content->id }}">{{ $content->title }}</a></td>
        <td class="slug align-center nowrap" data-label="Slug"><a href="/contents/{{ $content->id }}">{{ $content->slug }}</a></td>
        <td class="align-center nowrap">
          <a class='button small' href='/contents/{{ $content->id }}'>View</a>
          <a class='button small' href='/contents/{{ $content->id }}/edit'>Edit</a>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>



@stop

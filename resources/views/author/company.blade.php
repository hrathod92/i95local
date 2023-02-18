<?php
  $page['title'] = 'Company Authors';
  $page['sideblocks'] = array( 'dashboard._block_user' );
  $page['css'] = 'dashboard';
?>

@extends( 'templates.default' )
@section( 'content' )

<p>
  <a class='button small icon-left' href='/authors/create'><i class="fa fa-plus"></i>Create Author</a>
</p>

<table class='blocks'>
  <thead>
    <tr>
      <th>Title</th>
      <th class="align-center">Action(s)</th>
    </tr>
  </thead>
  <tbody>
    @foreach ( $authors as $item )
      <tr>
        <td class="block-title" data-label="Title"><a href="/authors/{{ $item->id }}">{{ $item->title }}</a></td>
        <td class="action align-center nowrap">
          <a class='button small' href="/authors/{{ $item->id }}">view</a>
          <a class='button small' href="/authors/{{ $item->id }}/edit">edit</a>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

@stop

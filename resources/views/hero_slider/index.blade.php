<?php 
    $page['title'] = 'Admin - Hero Sliders';
    $page['sideblocks'] = array( 'dashboard._block_admin' );
    $page['css'] = 'dashboard';
?>

@extends( 'templates.default' )
@section( 'content' )

<p><a class='button small icon-left' href='/sliders/create'><i class="fa fa-plus"></i>Create Slider</a></p>

<table class='blocks'>
  <thead>
    <tr>
      <th>Title</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach ( $sliders AS $slider )
      <tr>
        <td class="block-title" data-label="Title"><a href="/sliders/{{ $slider->id }}">{{ $slider->title }}</a></td>
        <td><img style="max-width: 200px" src='/data/hero_sliders/{!! $slider->image !!}' /></td>
        <td class="nowrap align-center" data-label="Actions"><a class='button small' href='/sliders/{{ $slider->id }}/edit'>edit</a></td>
      </tr>
    @endforeach
  </tbody>
</table>

@stop
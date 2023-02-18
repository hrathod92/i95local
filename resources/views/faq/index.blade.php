<?php 
  $page['title'] = 'FAQs';
  $page['sideblocks'] = [ 'faq._block_sidebar' ];
  $page['css'] = 'faq-index'; 
?>

@extends( 'templates.default' )
@section( 'content' )

<table class='faqs'>
  <tr>
    <th class='align-center'>Ref No</th>
    <th class='align-center'>Title</th>
    <th class='align-center'>Type</th>
    <th class='align-center'>Action</th>
  </tr>
  @foreach ( $faqs AS $faq )
    <tr class="faq">
      <td class='faq-refno'>{{ $faq->refno }}</td>
      <td class="faq-title"><a href="/faqs/{{ $faq->id }}">{{ $faq->title }}</a></td>
      <td class='faq-type align-center'>{{ $faq->type }}</td>
      <td class="faq-action align-center">
        <a class='button small' href='/faqs/{{ $faq->id }}'>View</a>
        @if ( Auth::user()->role == 'admin' )
          <a class='button small' href='/faqs/{{ $faq->id }}/edit'>Edit</a>
        @endif
      </td>
    </tr>
  @endforeach
</table>

@stop

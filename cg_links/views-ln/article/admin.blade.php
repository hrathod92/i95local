<?php 
    $page['title'] = 'Admin - Articles';
    $page['sideblocks'] = [ 'article.admin._block_admin' ];
    $page['css'] = 'dashboard';
?>

@extends( 'templates.default' )
@section( 'content' )

<p>
  <a class='button small icon-left' href='/articles/create'><i class="fa fa-plus"></i>Create Article</a>
</p>

<h2>Articles (Reverse Chroniclogical)</h2>

@include( 'article.admin._block_admin_search' )

<h2>Articles (Reverse Chroniclogical)</h2>

<div class='articles'>
  <table>
    <thead>
    <tr>
      <th >Title</th>
      <th class="align-center">Category</th>
      <th>Date</th>
      <th class="align-center">Featured</th>
      <th class="align-center">Top</th>
      <th class="align-center">Publish</th>
      <th class="align-center">Status</th>
      <th class="align-center">Action</th>
    </tr>
    </thead>
    <tbody>
      @if ( $items->count() )
        @foreach ( $items AS $article )
          <tr>
            <td class="title" data-label="Title"><a href="/articles/{{ $article->id }}">{{ $article->title }}</a></td>
            <td class="type" data-label="Type">{!! $article->get5CatStrWithAnchors() !!}</td>
            <td class="date align-center nowrap" data-label="Date"><a href="/articles/{{ $article->id }}">{{ date( 'M d, Y', strtotime( $article->pub_date )) }}</a></td>
            <td class="status align-center nowrap" data-label="Featured"><a href="/articles/{{ $article->id }}">{{ $article->featured_id }}</a></td>
            <td class="status align-center nowrap" data-label="Top"><a href="/articles/{{ $article->id }}">{{ $article->top_id }}</a></td>
            <td class="status align-center nowrap" data-label="Publish"><a href="/articles/{{ $article->id }}">{{ $article->publish_status['title'] }}</a></td>
            <td class="status align-center nowrap" data-label="Status"><a href="/articles/{{ $article->id }}">{{ $article->status['title'] }}</a></td>
            <td class="action align-center nowrap">
              <a class='button small' href="/articles/{{ $article->id }}/edit">edit</a>
            </td>
          </tr>
        @endforeach
      @else
         <tr><td colspan=10>No search results found.  <a href='/articles/admin'>Click to show all.</a></tr>
      @endif
    </tbody>
  </table>
</div>

@stop

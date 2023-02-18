<?php 
  $authors = \App\Author::where( 'company_id', $id )
    ->whereNotNull( 'image' )
    ->where( 'image', '<>', "" )
    ->orderBy( 'title' )
    ->get(); 
?>

@if ( $authors->count() > 0 )
  <div class="block bottom-line our-contributors">
    <h2>Our Contributors</h2>
    <div class="contributors-wrapper">
      @foreach ( $authors AS $author )
        <div class="contributor">
          <div class="round-image-wrapper"><a href='/authors/{{ $author->id }}'><img src="/data/authors/img/{{ $author->image }}" alt="{{ $author->title }}"></a></div>
        </div>
      @endforeach
    </div>
  </div>
@endif

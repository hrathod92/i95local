<?php
  $query = \App\Company::with( 'category' );
  if ( !empty( $terms )) $query = $query->search( $terms );
  $companies = $query->orderBy( 'title', 'ASC' )->get();
?>

<h2>Contributors</h2>
<div class='search-companies search-group'>
  @if ( $companies->count() )  
    @foreach ( $companies AS $company )
      <div class='search-company'>
        <div class="title" data-label="Title"><a href="/companies/{{ $company->id }}">{{ $company->title }}</a></div>
      </div>
    @endforeach
  @else
    <div class='article'>
      <div class="title" data-label="Title">No search results found.</div>
    </div>
  @endif
</div>

<?php $blockTypes = \App\Click::select( 'clickable_type' )
  ->distinct( 'clickable_type' )
  ->orderBy( 'clickable_type' )
  ->get();
?>

<h2>Type</h2>
<ul>

@if(\Auth::user()->role != 'admin' && !empty(Auth::user()->company_id ))
    <li><a class='link' href='/clicks/company/{{Auth::user()->company_id}}'>All</a></li>
@else
    <li><a class='link' href='/clicks'>All</a></li>
@endif  
  @foreach ( $blockTypes AS $blockType )
    <li><a class='link' href='/clicks/type/{{ $blockType->clickable_type }}'>{{ $blockType->clickable_type }}</a></li>
  @endforeach  
</ul>

<?php $blockCompanies = \App\Company::where( 'status_id', 0 )
  ->orderBy( 'title' )
  ->get();
?>
@if (\Auth::user()->role === 'admin')
<h2>Company</h2>
<ul>
  <li><a class='link' href='/clicks'>All</a></li>
  @foreach ( $blockCompanies AS $blockCompany )
    <li><a class='link' href='/clicks/company/{{ $blockCompany->id }}'>{{ $blockCompany->title }}</a></li>
  @endforeach  
</ul>
@endif



<?php 
  $blockCategoriesStr = $company->getCatStrWithAnchors(); 
	$company_url = \App\Company::find($id);
?>

@if ( !empty( $blockCategoriesStr ) && $company->category['slug'] != 'none' )
  <div class="block bottom-line our-expertise">
    <h2>Our Expertise</h2>
    <div class="expertise">{!! str_replace( ' | ', '<br />', $blockCategoriesStr ) !!}</div>
  </div>
@endif
@if(!empty($company_url))
  <div class="block">
    <ul class='actions'>
      @if ( strpos( $contact_us_url, 'http' ) !== false )
        <li><a class='button click-tracking' href='{{ $contact_us_url }}' data-click-type='article-contact' target='_blank'>Contact Us</a></li>
      @else
        <li><a class='button click-tracking' href='http://{{ $contact_us_url }}' data-click-type='article-contact' target='_blank'>Contact Us</a></li>
      @endif
    </ul>
  </div>
@endif
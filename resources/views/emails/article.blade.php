<?php 
    if($company_id != 0){
      $company_name = \App\Company::find($company_id)->first()->title;
    }
?>
@if(!empty($company_name))
    <h3>
      A new article has been submitted for approval by {{$company_name}}
    </h3>
@else
    <h3>
      A new article has been submitted for approval
    </h3>
@endif
<h4>
  {{$title}}
</h4>
<h5>
  {{$tagline}}
</h5>
<p>
  {!! nl2br($body) !!}
</p>

<p>
  Please review for publication.
</p>
<?php
  $body = \App\Setting::where('slug', 'email_ad_body')->first();
?>
<h3>
  A new ad space has been created for you!
</h3>
<p>
  {!! nl2br($body->body) !!}
</p>
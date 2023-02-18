<?php 
  $page['title'] = 'Contact Us';
  $page['sidebar'] = [ 'sidebar' ];
  $page['css'] = 'contact'; 
?>

@extends( 'templates.default' )
@section('head')
	<meta property="og:url"           content="{{ Request::fullUrl() }}" />
  	<meta property="og:type"          content="website" />
  	<meta property="og:title"         content="Contact Us | I95 Business" />
  	<meta property="og:description"   content="Contact Us | I95 Business" />
<title>Contact Us | I95 Business</title>
@endsection
@section( 'content' )

<div id='contact-info'>
	{!! \App\Block::where( 'slug', '=', 'contact-info' )->pluck( 'body' ) !!}
</div>

@if (count($errors) > 0)
    <div class="validation-errors">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{!! App\Content::where( 'slug', '=', 'contact-us' )->pluck( 'body' ) !!}

<!--[if lte IE 8]> 
<script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2-legacy.js"></script> 
<![endif]--> 
<script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2.js"></script> 
<script> 
hbspt.forms.create({ 
portalId: "3938123", 
formId: "8452866d-5ff6-4da7-addc-cb6a045ba48c" 
}); 
</script>

@stop
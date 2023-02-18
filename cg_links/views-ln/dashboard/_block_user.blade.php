<?php $userID = Auth::user()->id;
		$company_id =  Auth::user()->company_id;

?>

<h2>Content</h2>
<ul>
	<li><a href='/ads/company'>Ads</a></li>
	<li><a href='/articles/company'>Articles</a></li>
	<li><a href='/events/company'>Events</a></li>
	<li><a href='/jobs/company'>Jobs</a></li>
	<li><a href='/releases/company'>Releases</a></li>
	<li><a href='/videos/company'>Videos</a></li>
</ul>

<h2>Admin</h2>
<ul>
	<li><a href='/clicks/company/{{$company_id}}'>Analytics</a></li>	
	<li><a href='/authors/company'>Authors</a></li>
	<li><a href='/companies/company'>Company</a></li>
	<li><a href='/orders'>Orders</a></li>
	<li><a href='/faqs'>Help</a></li>
	<li><a href='/messages'>Messages</a></li>
@if ( Auth::check() && Auth::user()->role == 'admin' )
	<li><a href='/orders/products'>Products</a></li>
@endif
</ul>

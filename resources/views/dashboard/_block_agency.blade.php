
<h2>Client BrandPages</h2>
<ul>
	@foreach($clients as $client)
		@if($client->company_type_id == 0)
			<li><a href="/companies/{{ $client->id }}">{{ $client->title }}</a></li>
		@endif
	@endforeach
</ul>
<h2>Client Advertisers</h2>
<ul>
	@foreach($clients as $client)
		@if($client->company_type_id == 1)
			<li><a href="/companies/{{ $client->id }}">{{ $client->title }}</a></li>
		@endif
	@endforeach
</ul>

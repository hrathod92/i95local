<div id='sidebar-dashboard-user'>
	<p><a class='button' href="/">Home</a></p>
	<p><a class='button' href="/user/dashboard">Dashboard</a></p>
	@if ( Auth::user()->role == 'admin' || Auth::user()->role == 'user' )

		<h2>Admin</h2>
		<p><a class='button' href="/editors">Editor</a></p>
		<p><a class='button' href="/upload">Upload</a></p>
	@endif
	@if ( Auth::user()->role == 'admin' )
		<p><a class='button' href="/users">Users</a></p>
	@endif
</div>


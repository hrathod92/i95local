<p>Welcome to i95 Business, {{ $first_name }} {{ $last_name }}</p>
<p>Your account is now set up and ready for use.  Here is your user name and password to get started.</p>
<p>Username (email): {{ $email }}</p>
<p>Password: {{$password}}</p>
<p>Login at <a href="{{\URL::to('/')}}/user/register/{{$id}}">{{\URL::to('/')}}/user/register/{{$id}}</a></p>


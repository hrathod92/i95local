<ul class='sidebar-buttons'>
  @if ( Auth::check() && Auth::user()->role == 'admin' )
    <li><a class='button' href='/ads'>List</a></li>
  @endif
  <li><a class='button' href='/ads/{{ $item->slug }}/edit'>Edit</a></li>
</ul>

<style>
  #sidebar #sidebar-inner ul.sidebar-buttons {
    padding: 0;
  }
  #sidebar #sidebar-inner ul.sidebar-buttons li {
    list-style: none;
  }
  #sidebar #sidebar-inner ul.sidebar-buttons li a {
    width: 100%;
  }
</style>

<ul>
  @if($status == 0)
    <li><a class='button' href='/events/company/0/1'>View Inactive Events</a></li>
  @else
    <li><a class='button' href='/events/company'>View Active Events</a></li>
  @endif
</ul>


<style>
  #sidebar #sidebar-inner ul {
    margin: 0 auto;
    padding: 1.5em;
  }
  #sidebar #sidebar-inner ul li {
    list-style: none;
  }
  #sidebar #sidebar-inner ul li a.button {
    width: 100%;
    margin:  0 auto;
  }
</style>

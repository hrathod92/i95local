<ul>
  @if($status == 0)
    <li><a class='button' href='/users/1'>View Inactive Users</a></li>
  @else
    <li><a class='button' href='/users'>View Active Users</a></li>
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
  .hidden{
    display:none;
  }
  button{
    width:100%;
  }
  .disabled{
    background-color: #AAA !important;
    pointer-events:none;
  }
</style>

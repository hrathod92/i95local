<ul>
  @if($status == 0)
    <li><a class='button' href='/events/admin/1'>View Inactive Events</a></li>
  @else
    <li><a class='button' href='/events/admin'>View Active Events</a></li>
  @endif
  @if(count($export) > 1)
  <li>
    <form action="/export" method="post" accept-charset="utf-8">
      {{ csrf_field() }}
      <textarea class="hidden" name="json">{!! json_encode($export) !!}</textarea>
      <button name="type" value="xls" type="submit">Excel</button>
    </form>
  </li>
  @else
    <li><a class='button disabled' href='#'>Excel</a></li>
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

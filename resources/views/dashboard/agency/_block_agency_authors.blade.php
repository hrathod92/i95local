<span class="pull-left" style="margin-bottom:20px; margin-top:20px;"><a class='button small icon-left' href='agency/author/create/{{ $special->id }}'><i class="fa fa-plus"></i>Create Author</a></span>

<table>
    <table class='blocks'>
  <thead>
    <tr>
      <th>Title</th>
      <th class="align-center">Action(s)</th>
    </tr>
  </thead>
  <tbody>
    @foreach ( $authors as $item )
      <tr>
        <td class="block-title" data-label="Title"><a href="/authors/{{ $item->id }}">{{ $item->title }}</a></td>
        <td class="action align-center nowrap">
          <a class='button small' href="/authors/{{ $item->id }}">view</a>
          <a class='button small' href="/authors/{{ $item->id }}/edit">edit</a>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
    

<style>
  .dashboard-block span {
    display: inline-block;
  }
  .dashboard-block span:nth-child(1) {
    width: 10em;
  }
  .dashboard-block span:nth-child(2) {
    width: 10em;
  }
  .dashboard-block .read-more {
    margin-top: 1em;
  }
  .dashboard-block .read-more a {
    padding: 0.15em 1em;
  }
</style>

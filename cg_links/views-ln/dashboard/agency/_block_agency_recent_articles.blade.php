<span class="pull-left" style="margin-bottom:20px; margin-top:20px;"><a class='button small icon-left' href='agency/article/create/{{ $special->id }}'><i class="fa fa-plus"></i>Create Article</a></span>

<table>
    <thead>
        <tr>
            <th colspan="8">Pending Approval</th>
        </tr>
        <tr>
          <th >Title</th>
          <th class="align-center">Category</th>
          <th>Date</th>
          <th class="align-center">Featured</th>
          <th class="align-center">Top</th>
          <th class="align-center">Publish</th>
          <th class="align-center">Status</th>
          <th class="align-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ( $articlesPending AS $article )
          <tr>
            <td class="title" data-label="Title"><a href="/articles/{{ $article->id }}">{{ $article->title }}</a></td>
            <td class="type" data-label="Type">{!! $article->get5CatStrWithAnchors() !!}</td>
            <td class="date align-center nowrap" data-label="Date"><a href="/articles/{{ $article->id }}">{{ date( 'M d, Y', strtotime( $article->pub_date )) }}</a></td>
            <td class="status align-center nowrap" data-label="Featured"><a href="/articles/{{ $article->id }}">{{ $article->featured_id }}</a></td>
            <td class="status align-center nowrap" data-label="Top"><a href="/articles/{{ $article->id }}">{{ $article->top_id }}</a></td>
            <td class="status align-center nowrap" data-label="Publish"><a href="/articles/{{ $article->id }}">{{ $article->publish_status['title'] }}</a></td>
            <td class="status align-center nowrap" data-label="Status"><a href="/articles/{{ $article->id }}">{{ $article->status['title'] }}</a></td>
            <td class="action align-center nowrap">
              <a class='button small' href="/articles/{{ $article->id }}/edit">edit</a>
            </td>
          </tr>
        @endforeach
    </tbody>
</table>

<table>
    <thead>
        <tr>
            <th colspan="8">Active Articles</th>
        </tr>
        <tr>
          <th >Title</th>
          <th class="align-center">Category</th>
          <th>Date</th>
          <th class="align-center">Featured</th>
          <th class="align-center">Top</th>
          <th class="align-center">Publish</th>
          <th class="align-center">Status</th>
          <th class="align-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ( $articlesCurrent AS $article )
          <tr>
            <td class="title" data-label="Title"><a href="/articles/{{ $article->id }}">{{ $article->title }}</a></td>
            <td class="type" data-label="Type">{!! $article->get5CatStrWithAnchors() !!}</td>
            <td class="date align-center nowrap" data-label="Date"><a href="/articles/{{ $article->id }}">{{ date( 'M d, Y', strtotime( $article->pub_date )) }}</a></td>
            <td class="status align-center nowrap" data-label="Featured"><a href="/articles/{{ $article->id }}">{{ $article->featured_id }}</a></td>
            <td class="status align-center nowrap" data-label="Top"><a href="/articles/{{ $article->id }}">{{ $article->top_id }}</a></td>
            <td class="status align-center nowrap" data-label="Publish"><a href="/articles/{{ $article->id }}">{{ $article->publish_status['title'] }}</a></td>
            <td class="status align-center nowrap" data-label="Status"><a href="/articles/{{ $article->id }}">{{ $article->status['title'] }}</a></td>
            <td class="action align-center nowrap">
              <a class='button small' href="/articles/{{ $article->id }}/edit">edit</a>
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


<span class="pull-left" style="margin-bottom:20px;"><a class='button small icon-left' href='agency/video/create/{{ $special->id }}' ><i class="fa fa-plus"></i>Create Video</a></span>

<table class='ads'>
    <thead>
    <tr>
        <th class="align-center">Title</th>
        <th class="align-center">Type</th>
        <th class="align-center">Favorite</th>
        <th class="align-center">Status</th>
        <th class="align-center">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach ( $videos AS $video )
        <tr>
            <td class="ad-title" data-label="Title"><a href="/videos/show/{{ $video->id }}">{{ $video->title }}</a></td>
            <td class="nowrap" data-label="Type"><a href="/videos/show/{{ $video->id }}">{{ $video->video_type['title'] }}</a></td>
            <td class="nowrap" data-label="Favorite"><a href="/videos/show/{{ $video->id }}">{{ $video->favorite['title'] }}</a></td>
            <td class="nowrap" data-label="Status"><a href="/videos/show/{{ $video->id }}">{{ $video->status['title'] }}</a></td>
            <td class="nowrap align-center" data-label="Actions">
              <a class='button small' href='/videos/{{ $video->id }}/edit'>edit</a>
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

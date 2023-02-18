<?php $page['title'] = 'Dashboard'; ?>
<?php $page['sideblocks'] = array( 'dashboard._block_admin' ); ?>
<?php $page['css'] = 'dashboard'; ?>

@extends( 'templates.default' )

@section( 'content' )

<table>
  <thead>
    <tr>
      <th>Content</th>
      <th class="align-center">Count</th>
      <th class="align-center">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Ads</td>
      <td class="nowrap align-center" data-label="Count">{{ App\Ad::count() }}</td>
      <td class="nowrap align-center" data-label="Action"><a class='button small' href='/ads'>List</a></td>
    </tr>
    <tr>
      <td>Articles</td>
      <td class="nowrap align-center" data-label="Count">{{ App\Article::count() }}</td>
      <td class="nowrap align-center" data-label="Action"><a class='button small' href='/articles/admin'>List</a></td>
    </tr>
    <tr>
      <td>Events</td>
      <td class="nowrap align-center" data-label="Count">{{ App\Event::count() }}</td>
      <td class="nowrap align-center" data-label="Action"><a class='button small' href='/events/admin'>List</a></td>
    </tr>
    <tr>
      <td>Feeds</td>
      <td class="nowrap align-center" data-label="Count">{{ App\Feed::count() }}</td>
      <td class="nowrap align-center" data-label="Action"><a class='button small' href='/feeds/admin'>List</a></td>
    </tr>
    <tr>
      <td>Jobs</td>
      <td class="nowrap align-center" data-label="Count">{{ App\Job::count() }}</td>
      <td class="nowrap align-center" data-label="Action"><a class='button small' href='/jobs/admin'>List</a></td>
    </tr>
    <tr>
      <td>Newsletters</td>
      <td class="nowrap align-center" data-label="Count">{{ App\Newsletter::count() }}</td>
      <td class="nowrap align-center" data-label="Action"><a class='button small' href='/newsletters/admin'>List</a></td>
    </tr>
    <tr>
      <td>Releases</td>
      <td class="nowrap align-center" data-label="Count">{{ App\Release::count() }}</td>
      <td class="nowrap align-center" data-label="Action"><a class='button small' href='/releases/admin'>List</a></td>
    </tr>
    <tr>
      <td>Sponsoreds</td>
      <td class="nowrap align-center" data-label="Count">{{ App\Sponsored::count() }}</td>
      <td class="nowrap align-center" data-label="Action"><a class='button small' href='/sponsoreds/admin'>List</a></td>
    </tr>
    <tr>
      <td>Videos</td>
      <td class="nowrap align-center" data-label="Count">{{ App\Video::count() }}</td>
      <td class="nowrap align-center" data-label="Action"><a class='button small' href='/videos/admin'>List</a></td>
    </tr>
  </tbody>
</table>

<table>
  <thead>
    <tr>
      <th>Admin</th>
      <th class="align-center">Count</th>
      <th class="align-center">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Agencies</td>
      <td class="nowrap align-center" data-label="Count">{{ App\Company::where('company_type_id', 2)->count() }}</td>
      <td class="nowrap align-center" data-label="Action"><a class='button small' href='/agency/admin'>List</a></td>
    </tr>
    <tr>
      <td>Analytics</td>
      <td class="nowrap align-center" data-label="Count">{{ App\Click::count() }}</td>
      <td class="nowrap align-center" data-label="Action"><a class='button small' href='/clicks'>List</a></td>
    </tr>
    <tr>
      <td>Authors</td>
      <td class="nowrap align-center" data-label="Count">{{ App\Author::count() }}</td>
      <td class="nowrap align-center" data-label="Action"><a class='button small' href='/authors/admin'>List</a></td>
    </tr>
    <tr>
      <td>Companies</td>
      <td class="nowrap align-center" data-label="Count">{{ App\Company::where('company_type_id','!=', 2)->count() }}</td>
      <td class="nowrap align-center" data-label="Action"><a class='button small' href='/companies/admin'>List</a></td>
    </tr>
    <tr>
      <td>Contacts</td>
      <td class="nowrap align-center" data-label="Count">{{ App\Contact::count() }}</td>
      <td class="nowrap align-center" data-label="Action"><a class='button small' href='/contacts'>List</a></td>
    </tr>
    <tr>
      <td>Help</td>
      <td class="nowrap align-center" data-label="Count">{{ App\Faq::count() }}</td>
      <td class="nowrap align-center" data-label="Action"><a class='button small' href='/faqs'>List</a></td>
    </tr>
    <tr>
      <td>Job Emails</td>
      <td class="nowrap align-center" data-label="Count">{{ App\Job::count() }}</td>
      <td class="nowrap align-center" data-label="Action"><a class='button small' href='/jobs/emails'>List</a></td>
    </tr>
    <tr>
      <td>Orders</td>
      <td class="nowrap align-center" data-label="Count">{{ App\Order::count() }}</td>
      <td class="nowrap align-center" data-label="Action"><a class='button small' href='/orders'>List</a></td>
    </tr>
    <tr>
      <td>Products</td>
      <td class="nowrap align-center" data-label="Count">{{ App\Product::count() }}</td>
      <td class="nowrap align-center" data-label="Action"><a class='button small' href='/products'>List</a></td>
    </tr>
    <tr>
      <td>Users</td>
      <td class="nowrap align-center" data-label="Count">{{ App\User::count() }}</td>
      <td class="nowrap align-center" data-label="Action"><a class='button small' href='/users'>List</a></td>
    </tr>
  </tbody>
</table>

<table>
  <thead>
    <tr>
      <th>Categories</th>
      <th class="align-center">Count</th>
      <th class="align-center">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
    <tr>
      <td data-label="Site">Categories</td>
      <td class="nowrap align-center" data-label="Count">{{ App\Category::count() }}</td>
      <td class="nowrap align-center" data-label="Action"><a class='button small' href='/categories'>List</a></td>
    </tr>
    <tr>
      <td>Job Types</td>
      <td class="nowrap align-center" data-label="Count">{{ App\JobType::count() }}</td>
      <td class="nowrap align-center" data-label="Action"><a class='button small' href='/job-types/admin'>List</a></td>
    </tr>
    <tr>
      <td>Video Types</td>
      <td class="nowrap align-center" data-label="Count">{{ App\VideoType::count() }}</td>
      <td class="nowrap align-center" data-label="Action"><a class='button small' href='/video-types/admin'>List</a></td>
    </tr>
  </tbody>
</table>

<table>
  <thead>
    <tr>
      <th>Site</th>
      <th class="align-center">Count</th>
      <th class="align-center">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td data-label="Site">Blocks</td>
      <td class="nowrap align-center" data-label="Count">{{ App\Block::count() }}</td>
      <td class="nowrap align-center" data-label="Action"><a class='button small' href='/blocks'>List</a></td>
    </tr>
    <tr>
      <td data-label="Site">Contents (Pages)</td>
      <td class="nowrap align-center" data-label="Count">{{ App\Content::count() }}</td>
      <td class="nowrap align-center" data-label="Action"><a class='button small' href='/contents'>List</a></td>
    </tr>
    <tr>
      <td data-label="Site">Menus</td>
      <td class="nowrap align-center" data-label="Count">{{ App\Menu::count() }}</td>
      <td class="nowrap align-center" data-label="Action"><a class='button small' href='/menus'>List</a></td>
    </tr>
    <tr>
      <td data-label="Site">Settings</td>
      <td class="nowrap align-center" data-label="Count">{{ App\Setting::count() }}</td>
      <td class="nowrap align-center" data-label="Action"><a class='button small' href='/settings'>List</a></td>
    </tr>
  </tbody>
</table>

@stop

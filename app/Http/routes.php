<?php

// Home
Route::get( '/', 'HomeController@getIndex' );
Route::get('home', 'HomeController@getIndex' );
Route::get('altupdates', 'AdController@updateAlts');

// Articles
Route::get( 'articles/update-slug', 'ArticleController@updateSlug' );
Route::get( 'articles/content/{slug}', 'ArticleController@content' )->name('articles.content'); //js added this 2/5/2018
Route::get( 'articles/company/{id?}', 'ArticleController@company' );
Route::get( 'articles/import', 'ArticleController@import' );
Route::get( 'articles/category/{slug}', 'ArticleController@index' )->name('articles.category');
Route::get( 'articles/index/{categoryID?}', 'ArticleController@index' );
Route::get( 'articles/admin/{categoryID?}', 'ArticleController@admin' );
Route::get( 'articles/email_queue', 'ArticleController@emailQueue' );
Route::get( 'article-reads/{id?}', 'ArticleController@show' );
Route::get( 'article-contacts/{id?}', 'ArticleController@show' );
Route::get('/articles/api/ajax-state',function()
{
    $id = Input::get('id');
    $company_url = \App\Company::where('id',$id)->select('contact_us_url')->first();
    return $company_url;

});
Route::resource( 'articles', 'ArticleController' );

// Newsletters
Route::get( 'newsletters/admin', 'NewsletterController@admin' );
Route::get( 'newsletters/archive', 'NewsletterController@index' );
Route::get( 'newsletters/archive/year/{newsletter_year?}', 'NewsletterController@index' )->name('newsletter.year');
Route::get( 'newsletters/current', 'NewsletterController@show' );
Route::get( 'newsletter', 'NewsletterController@show' );
Route::get( 'magazine', 'NewsletterController@show' );
Route::resource( 'newsletters', 'NewsletterController' );


// FAQs
Route::get( 'faqs/admin', 'FaqController@admin' );
//sitemap
Route::get( 'sitemap', 'FaqController@getSitemap' );
Route::resource( '/faqs', 'FaqController' );

// Companies
Route::get( 'companies/user', 'CompanyController@user' );
Route::get( 'companies/company', 'CompanyController@company' );
Route::get( 'companies/admin/{status_id?}', 'CompanyController@admin' );
Route::resource( 'companies', 'CompanyController' );

// Add URL safe slugs 
// Route::get('script/mass_slug_update', 'CompanyController@generate_all_company_slugs');
// Route::get('script/rerun_mass_slug_update', 'CompanyController@rerun_url_slug');

Route::get( 'contributors/admin', 'CompanyController@admin' );
Route::resource( 'contributors', 'CompanyController' );

// Agency
Route::get( 'agency/user', 'AgencyController@user' );
Route::get( 'agency/company', 'AgencyController@company' );
Route::get( 'agency/admin/{status_id?}', 'AgencyController@admin' );
Route::get( 'agency/remove/{company_id?}/{agency_id?}', 'AgencyController@remove' );
Route::get( 'agency/terminate/{company_id?}/{agency_id?}', 'AgencyController@dashboardRemove' );
Route::get( 'agency/add/{company_id?}/{agency_id?}', 'AgencyController@addClient' );
Route::patch('/agency/profile/update/{id}',['as' => 'agency.profile.update', 'uses' => 'AgencyController@profileUpdate']);
Route::get( 'agency/ad/create/{id}', 'AgencyController@adCreate' );
Route::patch('/agency/ad/store/{id}',['as' => 'agency.ad.store', 'uses' => 'AgencyController@storeAd']);
Route::get( 'agency/author/create/{id}', 'AgencyController@authorCreate' );
Route::patch('/agency/author/store/{id}',['as' => 'agency.author.store', 'uses' => 'AgencyController@storeAuthor']);
Route::get( 'agency/article/create/{id}', 'AgencyController@articleCreate' );
Route::patch('/agency/article/store/{id}',['as' => 'agency.article.store', 'uses' => 'AgencyController@storeArticle']);
Route::get( 'agency/video/create/{id}', 'AgencyController@videoCreate' );
Route::patch('/agency/video/store/{id}',['as' => 'agency.video.store', 'uses' => 'AgencyController@storeVideo']);
Route::resource( 'agency', 'AgencyController' );

// Videos
Route::get( 'videos/company/{id?}', 'VideoController@company' );
Route::get( 'videos/admin', 'VideoController@admin' );
Route::get( 'videos/type/{video_type_id?}', 'VideoController@index' )->name('videos.type');
Route::get( 'videos/{video_id?}/edit', 'VideoController@edit' );
Route::get( 'videos/show/{video_id?}', 'VideoController@show' );
Route::resource( 'videos', 'VideoController' );

// Content
Route::get( 'content/{slug}', 'ContentController@content' );
Route::get( 'subscribe', 'ContentController@contact' );

// Releases
Route::get( 'releases/company/{id?}', 'ReleaseController@company' );
Route::get( 'releases/type/{release_type_id?}', 'ReleaseController@index' )->name('releases.type');
Route::get( 'releases/admin', 'ReleaseController@admin' );
Route::post('upload_image','ReleaseController@uploadImage')->name('upload');
Route::resource( 'releases', 'ReleaseController' );

// Contacts
Route::get( 'contact-us', 'ContactController@create' );
Route::post( 'contacts','ContactController@postIndex' );
Route::resource( 'contacts', 'ContactController' );

// Events
Route::get( 'events/company/{id?}/{status?}', 'EventController@company' );
Route::get( 'events/admin/{status?}', 'EventController@admin' );
Route::get( 'events/show/{slug}', 'EventController@view' );
Route::get( 'events/admin-create', 'EventController@acreate' );
Route::post( 'events/remove', 'EventController@remove' );
Route::get( 'events/type/{event_type_id?}', 'EventController@index' )->name('events.type');
Route::resource('events','EventController');

// Jobs
Route::get( 'jobs/emails', 'JobController@emails' );
Route::get( 'jobs/company/{id?}', 'JobController@company' );
Route::get( 'jobs/admin', 'JobController@admin' );
Route::get( 'jobs/type/{job_type_id?}', 'JobController@index' )->name('jobs.type');
Route::get( 'jobs/type/{job_types?}', 'JobController@indexByType' )->name('jobs.by-type');
Route::post( 'jobs/email-required', 'JobController@postEmailRequired' );
Route::resource( 'jobs', 'JobController' );

// Dashboard
Route::get( 'dashboard/admin/{id?}', 'DashboardController@getAdmin' );
Route::get( 'dashboard/user/{id?}', 'DashboardController@getUser' );
Route::get( 'dashboard', 'DashboardController@getDashboard' )->name('dashboard');

// Users
Route::get( 'users/{status?}', 'UserController@getIndex' );
Route::get( 'user/view/{id}', 'UserController@getView' );
Route::get( 'user/account', 'UserController@getAccount' );

Route::get( 'user/login', 'UserController@getLogin' )->name('user.login');
Route::post( 'user/login', 'UserController@postLogin' );
Route::get( 'user/logout', 'UserController@getLogout' );

Route::get( 'user/create', 'UserController@getCreate' )->name('user.register');
Route::post( 'user/create', 'UserController@postCreate' );

Route::get( 'user/create_confirm', 'UserController@getCreateConfirm' );
Route::get( 'user/register/{id}', 'UserController@getRegister' );
Route::get( 'user/edit/{id}', array('as' => 'user.edit', 'uses' => 'UserController@getEdit' ));
Route::post( 'user/edit/{id}', 'UserController@postEdit' );

Route::get( 'user/password', 'UserController@getPassword' );
Route::post( 'user/password', 'UserController@postPassword' );

Route::get( 'user/reset/{id}', 'UserController@getReset' );
Route::post( 'user/reset', 'UserController@postReset' );

Route::get('pending-registrations','UserController@getPendingRegistrations');
Route::post('send-registration-email','UserController@sendRegistrationEmail');

// Search
Route::get( 'search', 'SearchController@index' );


// Update Slug
Route::get( 'updateSlug', 'AdController@updateSlug' );
Route::get( 'updateEvent', 'EventController@updateSlug' );

// Categories
Route::resource('categories', 'CategoryController');

// Clicks
Route::get( 'clicks/company/{id}', 'ClickController@company' );
Route::get( 'clicks/filter/{company?}/{type?}', 'ClickController@index' );
Route::post( 'clicks/set/{type}/{item_id}', 'ClickController@set' );
Route::post( 'clicks/{type}/{item_id}', 'ClickController@setFromFrontEnd' );
Route::get( 'clicks', 'ClickController@index' );

// Emails
Route::get('emails/order-reminder','EmailController@orderReminder');

// Ads
Route::get( 'ads/view/{id}', 'AdController@view' );
Route::get( 'ads/company', 'AdController@company' );
Route::get( 'ads/destroy/{id}', 'AdController@destroy' );
Route::resource('ads','AdController');

// Feeds
Route::get( 'feeds/admin', 'FeedController@admin' );
Route::post( 'feeds/remove', 'FeedController@remove' );
Route::resource('feeds','FeedController');

// Campaigns
Route::get( 'campaigns/admin', 'CampaignController@admin' );
Route::resource( 'campaigns', 'CampaignController' );

// Orders
Route::get( 'orders/subscription', 'OrderController@subscription' )->name('orders.subscription');
Route::get( 'products/catalog', 'OrderController@products' );
Route::get( 'orders/user', 'OrderController@user' );
Route::get( 'orders/purchase_confirmation', 'OrderController@purchaseConfirmation')->name('orders.purchase-confirmation');
Route::resource( 'orders', 'OrderController' );

// Products
Route::resource( 'products/admin', 'ProductController@admin' );
Route::resource( 'products', 'ProductController' );

// Accounts
Route::resource( 'accounts', 'AccountController' );

// Authors
Route::post( 'authors/api/get-company-authors/{company_id}', 'AuthorController@apiGetCompanyAuthors' );
Route::get( 'authors/company/{id?}', 'AuthorController@company' )->name('authors.company');
Route::get( 'authors/admin', 'AuthorController@admin' );
Route::resource( 'authors', 'AuthorController' );

// Spnosoreds
Route::get( 'sponsoreds/admin', 'SponsoredController@admin' );
Route::resource( 'sponsoreds', 'SponsoredController' );

// Messages
Route::get( 'messages/user/{id?}', 'MessageController@user' );
Route::get( 'messages/admin', 'MessageController@admin' );
Route::resource( 'messages', 'MessageController' );

Route::group(['middleware' => ['auth']], function () {
    Route::resource( 'ads', 'AdController' );
});
Route::get('rss/feed', function(){
	$collect = \App\Article::where('status_id', 0)->where('publish_status_id', 1)->orderBy('pub_date', 'desc')->take(20)->get();
	$xml = new \XMLWriter();
	@date_default_timezone_set("GMT");
    $xml->openMemory();
    $xml->startDocument('1.0');
		$xml->startElement('rss'); 
			$xml->writeAttribute('version', '2.0'); 
			$xml->writeAttribute('xmlns:atom', 'http://www.w3.org/2005/Atom');
			$xml->startElement('atom:link');
				$xml->writeAttribute('href', 'https://i95business.com/rss/feed');
				$xml->writeAttribute('rel', 'self');
				$xml->writeAttribute('type', 'application/rss+xml');
			$xml->endElement();
			$xml->startElement('channel');
				$xml->writeElement('title', 'I95 Business News Feed');
				$xml->writeElement('link', 'https://i95business.com');
				$xml->writeElement('description', "95 BUSINESS delivers direct access to business executives, decision-makers and professionals doing business in Baltimore's strategic business corridors.");
				foreach($collect as $record){
					$xml->startElement('item');
						$xml->writeElement('title', $record->title);
						$xml->writeElement('link', url().'/articles/content/'.$record->slug);
						$xml->writeElement('description', $record->title);
						$xml->startElement('image');
							$xml->writeElement('url', url().'/data/articles/img/'.$record->image);
							$xml->writeElement('title', !empty($record->image_caption) ? $record->image_caption : $record->title );
							$xml->writeElement('link', url());
						$xml->endElement();
					$xml->endElement();
				}    
			$xml->endElement();
		$xml->endElement();
    $xml->endDocument();

    $content = $xml->outputMemory();
    $xml = null;
    return response($content)->header('Content-Type', 'text/xml');
});
// Export
Route::post('export', function () {
  $json = json_decode(request()->json, true);
  $fileName = $json['reportName'].'_'.\Carbon\Carbon::now()->format('m_d_Y');
  $headers = [];
  foreach ($json as $index => $row) {
    $headers = array_merge($headers, array_keys((array)$row));
  }
  $headers = array_unique($headers);
  Excel::create($fileName, function($excel) use($json, $headers, $fileName) {
    $excel->setTitle($fileName);
    $excel->setCreator('I-95')
          ->setCompany('I-95');

    $excel->sheet('Sheet 1', function($sheet) use($json, $headers) {
      foreach ($json as $index => $row) {
        if ($row == reset($json)) {
          $sheet->appendRow($headers);
        }
        $sheet->appendRow(array_values((array)$row));
      }
      $sheet->freezeFirstRow();
    });
  })->download(request()->type);
  return redirect(url()->previous());
})->name('export');

// Authenticated and admin only
Route::group(['middleware' => ['auth', 'role:admin']], function () {
	Route::resource( 'blocks', 'BlockController' );
	Route::resource( 'contents', 'ContentController' );
	Route::resource( 'menus', 'MenuController' );
	Route::resource( 'settings', 'SettingController' );
	Route::resource( 'sliders', 'HeroSliderController' );
	
	// Job Types
	Route::get( 'job-types/admin', 'JobTypeController@admin' )->name( 'job-types.admin' );
	Route::resource( 'job-types', 'JobTypeController' );
	
	// Video Types
	Route::get( 'video-types/admin', 'VideoTypeController@admin' )->name('video-types.admin');
	Route::resource( 'video-types', 'VideoTypeController' );


});

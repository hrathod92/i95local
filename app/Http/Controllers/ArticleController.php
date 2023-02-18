<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use \App\Article;
use \App\Company;
use \App\Click;
use URL;

class ArticleController extends Controller
{

	public function __construct()
	{
			$this->middleware( 'auth', [ 'except' => [ 'index', 'show', 'content' ]]);
			$this->middleware('site');
			//$this->middleware( 'role:admin', [ 'except' => [ 'index', 'show' ]]);
			$this->beforeFilter( 'csrf', array( 'on'=>'post' ));
	}

	public function index( $slug='' )
	{
		$query = Article::with( 'category', 'click' )->publishedAndActive();
		if ( $slug != '' && $slug != 'all' ) {
			$category = \App\Category::with( 'parent' )->where( 'slug', $slug )->first();
			$categoryID = isset( $category->id ) ? $category->id : 0;
			$query = $query->category( $categoryID );
		} else {
			$categoryID = 0;
		}
		
		if ( $search_string = \Input::get( 'search_string' )) {
			$query = $query->searchWithCompanyAuthor( $search_string );
		}

		$data['items'] = $query->orderBy( 'articles.id', 'DESC' )->get();
		$data['category'] = isset( $category ) ? $category : null;
		$data['categoryID'] = $categoryID;
		$data['slug'] = $slug;
		$data[ 'search_string' ] = $search_string;
		return view( 'article.index', $data );
	}

	public function import()
	{
		$data['items'] = 'test1';
		return view( 'article.import', $data );
	}

    public function emailQueue(){

	    $data['items'] = $query = Article::with( 'category' )
            ->where("email_queue_status_id", 1)
            ->orderBy( 'id', 'DESC' )->get();

        return view( 'article.email_queue', $data );
    }

	public function admin( $categoryID=0 )
	{
		$query = Article::with( 'category' );
		if ( $categoryID != 0 ) $query = $query->category( $categoryID );
		if ( $search_string = \Input::get( 'search_string' )) {
			$query = $query->where( 'title', 'LIKE', '%' . $search_string . '%' );
		}
		$data['items'] = $query->orderBy( 'id', 'DESC' )->get();
		$data['categoryID'] = $categoryID;
		$data[ 'search_string' ] = $search_string;
		return view( 'article.admin', $data );
	}
	
	public function company( $id=0 )
	{
		if ( $id == 0 || \Auth::user()->role != 'admin' ) $id = \Auth::user()->company_id;
		$data['items'] = Article::with( 'category' )
			->where( 'company_id', $id )
			->orderBy( 'id', 'DESC' )
			->get();
		$data['company'] = Company::find ( $id );
		return view( 'article.company', $data );
	}

	
		public function content($slug)
	{
		$data = Article::with( 'company', 'author' )->where('slug',$slug)->first();
    if (!$data) {      
      $slug = str_replace("-", "_", $slug);
  		$data = Article::with( 'company', 'author' )->where('slug',$slug)->first();
    }
    if (!$data) {
      $slug = str_replace("_", "-", $slug);
  		$data = Article::with( 'company', 'author' )->where('slug',$slug)->first();
    }      
		$data['categoryID'] = $data->category_id;
		Click::set( 'article', $data->id);
		return view( 'article.show', $data )->withData( $data );
	}
	
	public function show($id)
	{
		Click::set( 'article', $id );
		$data = Article::with( 'company', 'author' )->find( $id );
		$data['categoryID'] = $data->category_id;
		return view( 'article.show', $data )->withData( $data );
	}

	public function create()
	{
		return view( 'article.create' );
	}

	public function store(Request $request)
	{
		$input = \Input::except(['image']);

		$data = Article::create( $input );
		$data->category_id = $request->input('category_id');
		$file=$request->file('image');
		if (isset($file)){
			$imageName='articles-'. $data->id .'.'.$request->file('image')->getClientOriginalExtension();
			$destinationPath = base_path() . '/public/data/articles/img';
			$request->file('image')->move($destinationPath, $imageName);
			$data->image=$imageName;
		}
		
		$data->slug = \Str::slug($data->title, '-')."-".$data->id;
		$data->save();
		
		if($data->publish_status_id == 1){
			$error = \App\Helpers\Email::newArticle($data->id);
		}
		
		//sends mail on new article submission
		//$sendNotify = \App\Helpers\Email::articleSubmitted($data->id);
		$newMess = \App\Helpers\Message::postNew($data->author_id,$data->company_id, 'Article Created - '.$data->title, "Your Article has been created.");
		return redirect()->action( 'ArticleController@show', [ 'id' => $data->id ] );
	}

	public function edit($id)
	{
		$data['article'] = Article::find( $id );
		return view( 'article.edit', $data );
	}

	public function update(Request $request, $id)
	{
		$input = \Input::except( array( 'submit', '_token', '_method', 'image', 'image_delete', 'video_thumbnail'  ));
		$record = Article::find( $id );
		if($record->status_id == 1 && $request->status_id == 0){
			$newMess = \App\Helpers\Message::postNew($record->author_id, $record->company_id, 'Article Approved - '.$record->title, "Your Article has been approved.");
		}
		foreach ( $input AS $key => $value ) {
			$record[$key] = $value;
		}
		$file=$request->file('image');
		if ( isset( $file )) {
			$imageName='articles-'.$id.'.'.$request->file('image')->getClientOriginalExtension();
			$destinationPath = base_path() . '/public/data/articles/img';
			$request->file('image')->move($destinationPath, $imageName);
			$record['image']=$imageName;
			$record['video_id'] = '';
		} elseif ( isset( $request->image_delete )) {
			$record['image'] = null;
		}
		if(!empty($record->contact_us_url) && !URL::isValidUrl($record->contact_us_url)){
		 $record->contact_us_url = null;
		}
		$record->slug = \Str::slug($record->title, '-')."-".$record->id;
		$record->save();
		
		if($record->publish_status_id == 1 && $record->status_id != 0){
			$error = \App\Helpers\Email::newArticle($record->id);
		}
		
		$record->preview = true;
		return redirect()->action( 'ArticleController@show', [ 'id' => $id ] );
	}
	
	  public function updateSlug(){
    	$articles = Article::all();
		foreach($articles as $article){
		  $article->slug = \Str::slug($article->title, '-');
		  $article->save();
		}
		return redirect('articles');
	  }

	public function destroy($id)
	{
		$data= Article::find($id);
		$data->delete();
		$this->index();
	}

}

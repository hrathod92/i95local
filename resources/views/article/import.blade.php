<?php
  $page['title'] = 'Import';
?>

@extends( 'templates.default' )
@section( 'content' )

<?php 

print_r( $items ); 
$url = "http://i95.cg-dev2.com/uploads/i95businessmagazine.wordpress.2017.xml";
$xml = simplexml_load_file($url);
		$posts = array();
		foreach($xml->channel->item as $item)
		{
			$categories = array();
			foreach($item->category as $category)
			{
				//echo $category['domain'];
				if($category['nicename'] != "uncategorized" && $category['domain'] == "category")
				{
					//echo 'Yep';
					$categories[] = $category['nicename'];
				}
			}
			$content = $item->children('http://purl.org/rss/1.0/modules/content/');
			
			$posts[] = array(
				"title"=>$item->title,
				"body"=>$content->encoded,
				"pubDate"=>$item->pubDate,
				"categories"=>implode(",", $categories),
				"slug"=>$item->guid,
				"status"=>$item->status
			);
    }

		foreach ( $posts AS $post ) {
			echo $post['title'] . '<br />';
			echo $post['categories'] . '<br />';
			echo $post['pubDate'] . '<br />';
			echo $post['slug'] . '<br />';
			echo $post['body'] . '<br /><hr />';
			
			$article= new App\Article;
      $article->title = $post['title'];
      $article->categories = $post['categories'];
      $article->pub_date = $post['pubDate'];
      $article->slug = $post['slug'];
      $article->body = $post['body'];
      $article->status_id = 1;
      $article->save();
		}

	?>
@stop

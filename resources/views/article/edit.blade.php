<?php
	$page['title'] = 'Article - Edit';
	if ( Auth::user()->role == 'admin' ) {
		$page['sideblocks'] = [ 'dashboard._block_admin' ];
	} else {
		$page['sideblocks'] = [ 'dashboard._block_user' ];
	}
	$page['css'] = 'dashboard';
?>

@extends( 'templates.default' )
@section( 'content' )

{!! Form::model( $article, [ 'method' => 'PATCH', 'route' => [ 'articles.update', $article->id ], 'files' => true ] ) !!} 
	@include( 'article._edit' ) 
{!! Form::close() !!}

<script type="text/javascript" src="/js/ckeditor/ckeditor.js"></script>

@if(Auth::user())
	<script>
		CKEDITOR.replace('body', {
			filebrowserBrowseUrl: '/ckfinder/ckfinder.html?type=Files',
			filebrowserImageBrowseUrl: '/ckfinder/ckfinder.html?type=Files',
		});
	</script>
@else
	<script>
		CKEDITOR.replace('body', {
			filebrowserImageUploadUrl: '/ckeditor/plugins/imgupload/imgupload.php'
		});
	</script>
@endif

@stop

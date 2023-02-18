<?php
  $page['title'] = 'Article - Create';
	if ( Auth::user()->role == 'admin' ) {
		$page['sideblocks'] = [ 'dashboard._block_admin' ];
	} else {
		$page['sideblocks'] = [ 'dashboard._block_user' ];
	}
  $page['css'] = 'dashboard';
?>

@extends( 'templates.default' )
@section( 'content' )

{!! Form::model( new App\Article, ['method' => 'PATCH', 'route' => [ 'agency.article.store' ], 'class'=>'', 'files' => true ]) !!}
    @include( 'agency.article._edit' )
{!! Form::close() !!}

<script type="text/javascript" src="/js/ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('body', {
            filebrowserBrowseUrl: '/ckfinder/ckfinder.html?type=Files',
	    filebrowserImageBrowseUrl: '/ckfinder/ckfinder.html?type=Files',
});
</script>

@stop

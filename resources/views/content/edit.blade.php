<?php
    $page['title'] = 'Content - Edit';
    $page['sideblocks'] = [ 'dashboard._block_admin' ];
    $page['css'] = 'dashboard';
?>

@extends( 'templates.default' )
@section( 'content' )

{!! Form::model( $content, [ 'method' => 'PATCH', 'route' => [ 'contents.update', $content->id ], 'files' => true]) !!}
    @include( 'content._edit' )
{!! Form::close() !!}      

<script type="text/javascript" src="/js/ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('body', {
    	filebrowserBrowseUrl: '/ckfinder/ckfinder.html?type=Files',
      filebrowserImageBrowseUrl: '/ckfinder/ckfinder.html?type=Files'
    });
</script>

@stop

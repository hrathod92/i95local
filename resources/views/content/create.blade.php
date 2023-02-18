<?php
    $page['title'] = 'Content - Create';
    $page['sideblocks'] = [ 'dashboard._block_admin' ];
    $page['css'] = 'dashboard';
?>

@extends( 'templates.default' )
@section( 'content' )

<ul>
  @foreach($errors->all() as $error)
    <li>{!! $error !!}</li>
  @endforeach
</ul>

{!! Form::model( new App\Content, ['route' => [ 'contents.store' ], 'class'=>'', 'files' => true ]) !!}
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

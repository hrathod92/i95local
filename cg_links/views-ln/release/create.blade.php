<?php $page['title'] = 'Release - Create'; ?>
<?php $page['css'] = 'release-create'; ?>

@extends( 'templates.default'  )
@section( 'content' )

{!! Form::model( new App\Release, ['route' => [ 'releases.store' ], 'class'=>'', 'files'=>true ]) !!}

    @include( 'release._edit' )
    
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
			filebrowserUploadUrl: '{{ route('upload',['_token' => csrf_token() ]) }}'
		});
	</script>
@endif

@stop
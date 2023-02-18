<?php $page['title'] = 'Uploaded Files'; ?>
<?php $page['breadcrumb'] = 'home > upload > index'; ?>
<?php $page['css'] = 'upload-index'; ?>

@extends( 'templates.default' )
@section( 'content' )
	<ul>
		@foreach ( $files AS $file )
			@if ( !in_array( $file, array( '.', '..' )))
				<li>
					<span>{{ $file }}</span>
					<?php $code = '<img style="float: none; width: 300px;" src="/files/' . $file . '" />'; ?>
					<span>{{ htmlspecialchars( $code ) }}</span>
				</li>
			@endif
		@endforeach
	</ul>
@stop

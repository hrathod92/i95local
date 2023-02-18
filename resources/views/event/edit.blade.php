<?php $page['title'] = 'Event - Edit'; ?>
<?php $page['css'] = 'block-edit'; ?>

@extends( 'templates.default' )
@section( 'content' )

{!! Form::model( $event, [ 'method' => 'PATCH', 'route' => [ 'events.update', $event->id ], 'files' => true ] ) !!}
  @include( 'event._edit' )
{!! Form::close() !!}  

<script>  
  $(function(){
    $( "#datepicker" ).datepicker();  
      $( "#format" ).change(function() {
         $( "#datepicker" ).datepicker( "option", "dateFormat", $(this).val() );
      });
    });
  $(function(){
    $( "#datepicker2" ).datepicker();  
      $( "#format" ).change(function() {
         $( "#datepicker2" ).datepicker( "option", "dateFormat", $(this).val() );
      });
    });
</script>

@if(Auth::user())
	<script>
		CKEDITOR.replace('description', {
			filebrowserBrowseUrl: '/ckfinder/ckfinder.html?type=Files',
			filebrowserImageBrowseUrl: '/ckfinder/ckfinder.html?type=Files',
		});
	</script>
@else
	<script>
		CKEDITOR.replace('description', {
			filebrowserUploadUrl: '{{ route('upload',['_token' => csrf_token() ]) }}'
		});
	</script>
@endif

@stop

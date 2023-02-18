<?php $page['title'] = 'Submit an Event'; ?>
<?php $page['css'] = 'block-create'; ?>

@extends( 'templates.default'  )
@section( 'content' )

<style>
  .disabled{
    display:none;
  }
</style>

{!! Form::model( new App\Event, ['route' => [ 'events.store' ], 'class'=>'', 'files' => true ]) !!}
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

<script>
  $('#register').attr('disabled','disabled');
  $('input#agree').on("click", function () {
      if ($(this).is(':checked')) {
        if ($.trim($('#email').val()) != ''){
         if ($.trim($('#title').val()) != ''){
           if ($.trim($('#datepicker').val()) != ''){
             $('#register').removeAttr('disabled');
           }
         }
        }
      } 
  });
</script>

<style>
  input[type='submit']:disabled {
    background: #ccc;
    color: #999;
  }
</style>
@stop
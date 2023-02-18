<?php $page['title'] = 'Submit an Event'; ?>
<?php $page['css'] = 'block-create'; ?>

@extends( 'templates.default' )
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
  CKEDITOR.replace( 'description',
  {
     filebrowserBrowseUrl : 'ckfinder/ckfinder.html',
     filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?type=Images',
     filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.html?type=Flash',
  } 
 );
</script>
@stop
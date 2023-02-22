{!! Form::label( 'title', 'Title' ) !!}
{!! Form::text( 'title' ) !!}

{!! Form::label( 'slug', 'Slug' ) !!}
{!! Form::text( 'slug' ) !!}

<?php $levelSelect = [ '1' => 'Child', '0' => 'Parent' ]; ?>
{!! Form::label( 'level', 'Level' ) !!}
{!! Form::select( 'level', $levelSelect, isset( $item->level ) ? $item->level : 0 ) !!}

<div class='category-parent'>
  {!! Form::label( 'parent_id', 'Parent' ) !!}
  {!! Form::select( 'parent_id', \App\Category::where( 'level', 0 )->orderBy( 'title' )->pluck( 'title', 'id' ), isset( $item->parent_id ) ? $item->parent_id : '' ) !!}
</div>

<div class="form-element">
  {!! Form::Label( 'status_id', 'Status' ) !!} 
  {!! Form::select( 'status_id', \App\Status::orderBy( 'id' )->pluck( 'title', 'id' ), isset( $category->status_id ) ? $category->status_id : 0 ) !!}
</div>

{!! Form::submit( 'Submit', array('class'=>'btn btn-large btn-primary btn-block category-btn' )) !!}

<script>
  $(document).ready(function () {
    
    var parent = $('#parent_id').val();
    var level = $('#level').val();
    if ( level == 0 ) $('.category-parent').hide(); 
    
    $("#level").change(function() {
      console.log( 'test');
      parent = $('#parent_id').val();
      level = $(this).val();
      if ( level == 0 ) {
        $('#parent_id').val( 0 );
        $('.category-parent').hide();
      } else {
        $('#parent_id').val( parent )
        $('.category-parent').show();        
      } 
    });

  });
</script>

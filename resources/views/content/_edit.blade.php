{!! Form::label( 'title', 'Title' ) !!}
{!! Form::text( 'title' ) !!}

{!! Form::label( 'slug', 'Slug' ) !!}
{!! Form::text( 'slug' ) !!}

{!! Form::label( 'body', 'Body' ) !!}
{!! Form::textarea( 'body' ) !!}

{!! Form::label( 'image', 'Image' ) !!}
<p>Current Image : {!! isset( $content ) ? $content->image : 'None' !!}</p>
{!! form::checkbox( 'image_delete', 'image_delete', false) !!} Delete Image?
{!! Form::file('image', null) !!}

{!! Form::label( 'sidebar', 'Sidebar (Block Slug)' ) !!}
{!! Form::text( 'sidebar', isset( $content ) ? $content->sidebar : '', ["style"=>'width: 100%;'] ) !!}

{!! Form::label( 'css', 'Style (CSS)' ) !!}
{!! Form::textarea( 'css' ) !!}

{!! Form::Label( 'ad_show_id', 'Show Ads' ) !!} 
{!! Form::select( 'ad_show_id', \App\Status::orderBy( 'id' )->pluck( 'title', 'id' ), isset( $content->ad_show_id ) ? $content->ad_show_id : '' ) !!}


<div class="form-actions">
	<br>
	<br>
	<br>
	{!! Form::submit( 'Submit', array('class'=>'btn btn-large btn-primary btn-block' )) !!}
</div>
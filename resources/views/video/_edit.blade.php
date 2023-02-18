<?php
    $user = Auth::user();
?>

{!! Form::label( 'title', 'Title' ),"<span class='video-create'>(* required)</span>" !!}
{!! Form::text( 'title' ) !!}

{!! Form::label( 'body', 'Description' ) !!}
{!! Form::textarea( 'body' ) !!}

@if($user->role == "admin")
    {!! Form::Label( 'company_id', 'Company' ) !!}
    {!! Form::select( 'company_id', \App\Company::orderBy( 'id' )->lists( 'title', 'id' )->prepend( 'None', 0 ), isset( $video->company_id ) ? $video->company_id : '' ) !!}
@else
    {!! Form::hidden('company_id', isset($video->company_id) ? $video->company_id : $user->company_id) !!}
@endif

{!! Form::Label( 'video_type_id', 'Type' ) !!}
{!! Form::select( 'video_type_id', \App\VideoType::orderBy( 'id')->lists( 'title', 'id' ), isset( $video->video_type_id ) ? $video->video_type_id : '' ) !!}

@if ( $user->role == 'admin' )
  {!! Form::Label( 'favorite_id', 'Favorite' ) !!}
  {!! Form::select( 'favorite_id', \App\Favorite::orderBy( 'id')->lists( 'title', 'id' ), isset( $video->favorite_id ) ? $video->favorite_id : '' ) !!}
@endif

{!! Form::label( 'embed', 'Embed Code' ),"<span class='video-create'>(* required)</span>" !!}
{!! Form::textarea( 'embed' ) !!}

{!! Form::label( 'youtube_video_id', 'YouTube Video ID' ),"<span class='video-create'>(* required)</span>" !!}
{!! Form::text( 'youtube_video_id' ) !!}

{!! Form::label( 'keywords', 'Keywords' ) !!}
{!! Form::text( 'keywords', null, [ 'maxlength' => '100' ] ) !!}

{!! Form::Label( 'status_id', 'Status' ) !!}
{!! Form::select( 'status_id', \App\Status::orderBy( 'id')->lists( 'title', 'id' ), isset( $video->status_id ) ? $video->status_id : '' ) !!}


{!! Form::submit( 'Submit', array('class'=>'btn btn-large btn-primary btn-block' )) !!}

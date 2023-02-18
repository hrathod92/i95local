<?php $page['title'] = 'Video - Create'; ?>
<?php $page['css'] = 'video-create'; ?>

@extends( 'templates.default' )
@section( 'content' )

<ul>
  @foreach($errors->all() as $error)
    <li>{!! $error !!}</li>
  @endforeach
</ul>

{!! Form::model( new App\Video, ['route' => [ 'videos.store' ], 'class'=>'' ]) !!}

    @include( 'video._edit' )
    
{!! Form::close() !!}

@stop
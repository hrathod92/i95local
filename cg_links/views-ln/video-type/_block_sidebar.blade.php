<h4>Video Types</h4>

<p>
    <a href="{{route('videos.index')}}">
        All
    </a>
</p>

@foreach($videoTypes as $videoType)

    <p>
        <a href="{{route('videos.by-type', [$videoType->id])}}">
            {{$videoType->title}}
        </a>
    </p>
@endforeach

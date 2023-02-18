<h4>Job Types</h4>

<p>
    <a href="{{route('jobs.index')}}">
        All
    </a>
</p>

@foreach($jobTypes as $jobType)

    <p>
        <a href="{{route('jobs.by-type', [$jobType->id])}}">
            {{$jobType->title}}
        </a>
    </p>
@endforeach

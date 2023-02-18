<?php $page['title'] = 'Profiles'; ?>
<?php $page['css'] = 'profile-index'; ?>

@extends( 'templates.default' )
@section( 'content' )

<div class='profiles'>
    @foreach ( $profiles AS $profile )
        <div class="profile">
            <div class="profile-title"><a href="/profiles/{{ $profile->id }}">{{ $profile->title }}</a></div>
            <div class="profile-description">{{ $profile->body }}</div>
        </div>
    @endforeach
</div>

@stop

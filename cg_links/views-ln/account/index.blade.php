<?php $page['title'] = 'Accounts'; ?>
<?php $page['css'] = 'account-index'; ?>

@extends( 'templates.default' )
@section( 'content' )

<div class='accounts'>
    @foreach ( $accounts AS $account )
        <div class="account">
            <div class="account-title"><a href="/accounts/{{ $account->id }}">{{ $account->title }}</a></div>
            <div class="account-description">{{ $account->body }}</div>
        </div>
    @endforeach
</div>

@stop

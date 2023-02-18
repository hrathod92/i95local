<?php $page['title'] = 'Products'; ?>
<?php $page['css'] = 'order-subscription'; ?>

@extends( 'templates.default' )

@section('head')
	<meta property="og:url"           	content="{{ Request::fullUrl() }}" /></meta>
  	<meta property="og:type"          	content="website" /></meta>
  	<meta property="og:title"         	content="Product Offerings | I95 Business" /></meta>
  	<meta property="og:description"   	content="Advertising Products and other offerings from I95 Business" /></meta>
    <title>Product Offerings | I95 Business</title>
@endsection

@section( 'content' )

<ul class='order-subsrcription-ctas'>
    <li><a class='button' href='/contact-us'>Contact Us</a></li>
    <li><a class='button' href='/products/catalog'>Packages & Products</a></li>
    <li><a class='button' href='/orders/create'>Buy Subscription Now</a></li>
</ul>

<div class='order-subsrcription-form'>
    {!! Form::open(['url' => '/orders']) !!}


    <div class='subscriptions'>
        @if($subscriptionOrder)
            @if(sizeof($subscriptions) > 0)
                <p>Upgrade <b>{{$subscriptionOrder->product->title}}</b> subscription to:</p>
            @else
                <p>You have <b>{{$subscriptionOrder->product->title}}</b> subscription</p>
            @endif

        @else
            <p>Subscribe to:</p>
        @endif

        @foreach ( $subscriptions AS $index => $subscription )
          <div class='subscription'>
            <div class='title'>
              {!! Form::radio( 'subscription', $subscription->id, !$index ) !!}
              <span>{{ $subscription->title }} @ ${{ $subscription->price }}/month</span>												
            </div>
            <div class='tagline'>{{ $subscription->tagline }}</div>
          </div>
        @endforeach

        @if(sizeof($services) > 0)
            @if(sizeof($subscriptions) > 0)
                <p>Or buy service:</p>
            @else
                <p>Buy service:</p>
            @endif

        @endif
        @foreach ( $services AS $service )
            <div class='subscription'>
                {!! Form::radio( 'subscription', $service->id ) !!}
                <span>{{ $service->title }} @ ${{ $service->price }}</span>
            </div>
        @endforeach
    </div>

    {!! Form::label( 'body', 'Notes' ) !!}
    {!! Form::textarea( 'body' ) !!}

    @include('order._add_credit_card', ["subscriptionOrder" => $subscriptionOrder])

    <br>
    {!! Form::checkbox('terms') !!}
    <a href="/content/terms-and-conditions"  target="_blank">I accept Terms & Conditions </a>
    {!! Form::submit( 'Submit', array('class'=>'btn btn-large btn-primary btn-block' )) !!}
    {!! Form::close() !!}
</div>

<style>
    #main #content-header .content-header-inner h1.title {
        text-align: center;
    }

    #main #main-inner {
        max-width: 80%;
    }

    #main #main-inner #content.sidebar {
        float: none;
        margin: 0 auto;
    }

    .order-subsrcription-form {
        float: left;
        width: 60%;
    }

    .order-subsrcription-ctas {
        float: right;
        width: 22em;
        margin-top: 3em;
    }

    .order-subsrcription-ctas li {
        list-style: none;
    }

    .order-subsrcription-ctas li a {
        width: 100%;
        padding: 1em 2em;
        margin-bottom: 1em;
    }
    .subscriptions .subscription .tagline {
      margin-left: 3em;
      font-size: 0.85em;
      color: #555;
    }
</style>  

@stop


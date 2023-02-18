<?php $page['title'] = 'Subscription'; ?>
<?php $page['sideblocks'] = [ 'order._block_ordersub_ctas' ]; ?>
<?php $page['css'] = 'order-subscription'; ?>

@extends( 'templates.default' )
@section('head')
	<meta property="og:url"           content="{{ Request::fullUrl() }}" />
  	<meta property="og:type"          content="website" />
  	<meta property="og:title"         content="Subscriptions | I95 Business" />
  	<meta property="og:description"   content="Subscriptions | I95 Business" />
<title>Subscriptions | I95 Business</title>
@endsection
@section( 'content' )

<div class='subscription-temp-message'>On-line ordering coming soon.  Contact us directly at <a href='/contact-us'>contact-us</a>.</div>

<div class='order-subsrcription-form'>
		{!! Form::open(['url' => '/orders']) !!}
			<?php
			$subscriptions = App\Product::where('product_type_id', 1)
				->where( 'status_id', 0 )
				->where( 'price', '>', 0 )
				->orderBy('title')
				->get()
			?>
			<div class='subscriptions'>
					@foreach ( $subscriptions AS $index => $subscription )
							<div class='subscription'>
								<div class='title'>
									{!! Form::radio( 'subscription', $subscription->id, !$index ) !!}
									<span>{{ $subscription->title }} @ ${{ $subscription->price }}/month</span>												
								</div>
								<div class='tagline'>{{ $subscription->tagline }}</div>
							</div>
					@endforeach
			</div>

			@include('order._costumer_info')

			<fieldset>
				<legend>Notes</legend>
				{!! Form::label( 'body', 'Notes' ) !!}
				{!! Form::textarea( 'body' ) !!}
			</fieldset>

			@include('order._add_credit_card')

			<div class="form-element text-align-right">
				{!! Form::checkbox('terms') !!}
				<a href="/content/terms-and-conditions"  target="_blank">I accept Terms & Conditions </a>
			</div>
			{{--
			<div class="form-actions">
				{!! Form::submit( 'Submit', array('class'=>'btn btn-large btn-primary btn-block' )) !!}
			</div>
			--}}
		{!! Form::close() !!}
</div>

<style>
	.subscriptions .subscription .tagline {
		margin-left: 3em;
		font-size: 0.85em;
		color: #555;
	}
	.subscription-temp-message {
		font-size: 1.25em;
		font-weight: bold;
		background: #fcc;
		padding: 2em;
		margin-bottom: 2em;
	}
</style>  

@stop


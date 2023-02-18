<?php $page['title'] = 'Orders'; ?>
<?php $page['css'] = 'order-index'; ?>

@extends( 'templates.default' )
@section( 'content' )

<div class='orders'>
    @if(sizeof($orders) == 0)
        <p>Currently there are no orders</p>
    @else
        <table>
            <thead>
            <tr>
                <th class="align-center">Order #</th>
                <th class="align-center">First Name</th>
                <th class="align-center">Last Name</th>
                <th class="align-center">Title</th>
                <th class="align-center">Company</th>
                <th class="align-center">Amount</th>
                <th class="align-center">Plan</th>
                <th class="align-center">Date</th>
                <th class="align-center">Status</th>
                <th class="align-center">Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach ( $orders AS $order )
                    <?php $data = json_decode( $order->data ); ?>
                    <tr>
                        <td class="nowrap" data-label="Order #">
                            <a href="/orders/{{ $order->id }}">{{ $order->id}}</a>
                        </td>
                        <td class="nowrap" data-label="First Name">
                           {{ $order->user ? $order->user->first_name : $data->guest_user->first_name }}
                        </td>
                        <td class="nowrap" data-label="Last Name">
                           {{ $order->user ? $order->user->last_name : $data->guest_user->last_name }}
                        </td>
                        <td data-label="Title">
                            <a href="/orders/{{ $order->id }}">{{ $order->title}}</a>
                        </td>
                        <td data-label="Company">
                          @if ( isset( $order->company ))
                            <a href="/companies/{{ $order->company->id }}">{{ $order->company->title}}</a>
                          @else
                            {{ $data->guest_user->company_name }}
                          @endif
                        </td>
                        <td data-label="Amount">
                            <a href="/products/{{ $order->product->id }}">{{ $order->product->price}}</a>
                        </td>
                        <td data-label="Plan">
                            <a href="/products/{{ $order->product->id }}">{{ $order->product->stripe_plan_id}}</a>
                        <td data-label="Date">{{ $order->created_at }}</td>
                        <td data-label="Status">{{ $order->status }}</td>
                        <td data-label="Action">
                            <a class='button small' href='/orders/{{ $order->id }}'>view</a>
                            @if ( \Auth::check() && \Auth::user()->role == 'admin' )
                              <a class='button small' href='/orders/{{ $order->id }}/edit'>edit</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@stop

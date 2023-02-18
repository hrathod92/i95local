<?php $page['title'] = 'Order - ' . $data->title; ?>
<?php $page['css'] = 'order-show'; ?>

@extends( 'templates.default' )
@section( 'content' )


    <div class="order">
        @if ( isset( $data->image ) && strlen( $data->image ) > 0 )
            <div class="order-image"><img src="/data/orders/img/{{ $data->image }}"></div>
        @endif
        <div>
            <p class='order-body'>
                <strong>First Name:</strong>
                {{ $data->user ? $data->user->first_name : json_decode($data->data)->guest_user->first_name }}
            </p>
        </div>
        <div>
            <p class='order-body'>
                <strong>Last Name:</strong>
                {{ $data->user ? $data->user->last_name : json_decode($data->data)->guest_user->last_name }}
            </p>
        </div>
        <div>
            <p class='order-body'>
                <strong>Description:</strong>
                {!! $data->body !!}
            </p>
        </div>

        <div>
            <p>
                <strong>Company:</strong>
                <a href="/companies/{{$data->company->id}}">{{$data->company->title}}</a>
            </p>
        </div>
        <div>
            <p>
                <strong>Amount:</strong>
                {{$data->product->price}}
            </p>
        </div>
        <div>
            <p>
                <strong>Product:</strong>
                {{$data->product->title}}
            </p>
        </div>
        <div>
            <p>
                <strong>Created at:</strong>
                {!! $data->created_at !!}
            </p>
        </div>
        <div>
            <p>
                <strong>Status:</strong>
                {!! $data->status !!}
            </p>
        </div>

        @if ( Auth::check() && Auth::user()->role == 'admin' )
            <div>
                <p>
                    <strong>Stripe:</strong>
                    {!! $data->stripe_id !!}
                </p>
            </div>

            <?php
            $additionalData = json_decode($data->data);
            ?>

            @foreach($additionalData as $name => $value)
                @if(is_object($value))
                    <strong>{{str_replace("_", " ", ucfirst($name))}}:</strong>
                    <div style="padding: 15px">
                        @foreach($value as $n => $v)
                            <div>
                                <p><strong>{{str_replace("_", " ", ucfirst($n))}}:</strong> {{$v}}</p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div>
                        <p><strong>{{str_replace("_", " ", ucfirst($name))}}:</strong> {{$value}}</p>
                    </div>
                @endif


            @endforeach
            <p><a href='/orders/{{ $data->id }}/edit'>edit</a></p>
        @endif

    </div>

@stop
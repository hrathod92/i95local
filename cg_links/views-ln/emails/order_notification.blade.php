<p>Order details:</p>


<div class="order">
    <div>
        <p class='order-body'>
            <strong>Description:</strong>
            {!! $order->body !!}
        </p>
    </div>
    @if($order->company_id)
        <div>
            <p>
                <strong>Company:</strong>
                {{$order->company->title}}
            </p>
        </div>
    @endif
    <div>
        <p>
            <strong>Amount:</strong>
            {{$order->product->price}}
        </p>
    </div>
    <div>
        <p>
            <strong>Product:</strong>
            {{$order->product->title}}
        </p>
    </div>
    <div>
        <p>
            <strong>Created at:</strong>
            {!! $order->created_at !!}
        </p>
    </div>
    <div>
        <p>
            <strong>Status:</strong>
            {!! $order->status !!}
        </p>
    </div>

    <div>
        <p>
            <strong>Stripe:</strong>
            {!! $order->stripe_id !!}
        </p>
    </div>

    <?php
    $additionalData = json_decode($order->data);
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
</div>
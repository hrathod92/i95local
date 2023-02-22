<?php $page['title'] = 'Are you sure that you want to make this order?'; ?>
<?php $page['css'] = 'order-subscription'; ?>

@extends( 'templates.default' )


@section( 'content' )
<?php
    $order = [];
    if(Session::has("order")){
        $order = Session::get('order')[0];
    }
?>

    @if(isset($order["subscription"]))
        <?php
            $product = \App\Product::find($order["subscription"])->first();
        ?>

        <div>
            <p><strong>Product:</strong>
            {{$product->title}} @ ${{$product->price}} {{$product->stripe_plan_id ? "/month": ""}}
            </p>
        </div>
    @endif

    @if(isset($order["body"]))
        <div>
            <p><strong>Notes:</strong>
                {{$order["body"]}}
            </p>
        </div>
    @endif

    @if(isset($order["first_name"]))
        <div>
            <p><strong>First Name:</strong>
                {{$order["first_name"]}}
            </p>
        </div>
    @endif

    @if(isset($order["last_name"]))
        <div>
            <p><strong>Last Name:</strong>
                {{$order["last_name"]}}
            </p>
        </div>
    @endif

    @if(isset($order["company_name"]))
        <div>
            <p><strong>Company Name:</strong>
                {{$order["company_name"]}}
            </p>
        </div>
    @endif

    @if(isset($order["email"]))
        <div>
            <p><strong>Email:</strong>
                {{$order["email"]}}
            </p>
        </div>
    @endif

    @if(isset($order["phone"]))
        <div>
            <p><strong>Phone:</strong>
                {{$order["phone"]}}
            </p>
        </div>
    @endif

    {!! Form::open(['url' => '/orders']) !!}

    {!! Form::label('confirm', "Yes", ["style" => "display:inline;"]) !!}
    {!! Form::radio('confirm', 1, True) !!}

    {!! Form::label('confirm', "No", ["style" => "display:inline;"]) !!}
    {!! Form::radio('confirm', 0) !!}

    <br/>
    <br/>
    {!! Form::submit("Confirm"); !!}

    <a id="back" class='button small' href='{{ URL::previous() }}'>Back</a>
    {!! Form::close() !!}

    <script>
        $(document).ready(function(){
            $("#back").click(function(e){
                e.preventDefault();
                var form = $(this).parents("form")[0];
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'back');
                hiddenInput.setAttribute('value', 1);
                form.appendChild(hiddenInput);

                // Submit the form
                form.submit();
            })
        });
    </script>


@stop


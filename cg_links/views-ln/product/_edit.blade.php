{!! Form::label( 'title', 'Title' ) !!}
{!! Form::text( 'title' ) !!}

{!! Form::label( 'tagline', 'Tagline' ) !!}
{!! Form::text( 'tagline' ) !!}

{!! Form::Label( 'product_type_id', 'Type' ) !!}
{!! Form::select( 'product_type_id', \App\ProductType::orderBy( 'id' )->lists( 'title', 'id' ), isset( $item->product_type_id ) ? $item->product_type_id : '' ) !!}

{!! Form::label( 'stripe_plan_id', 'Stripe Plan ID' ) !!}
{!! Form::text( 'stripe_plan_id' ) !!}

{!! Form::label( 'price', 'Price' ) !!}
{!! Form::text( 'price' ) !!}

{!! Form::label( 'body', 'Description' ) !!}
{!! Form::textarea( 'body' ) !!}

{!! Form::Label( 'status_id', 'Status' ) !!}
{!! Form::select( 'status_id', \App\Status::orderBy( 'id' )->lists( 'title', 'id' ), isset( $item->status_id ) ? $item->status_id : '' ) !!}

{!! Form::submit( 'Submit', array('class'=>'btn btn-large btn-primary btn-block' )) !!}

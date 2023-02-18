<?php

namespace App\Http\Controllers;

use App\Billing\StripeBilling;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use \App\Product;
use Validator;

class ProductController extends Controller
{
    public function index()
    {
			$data['items'] = Product::with( 'product_type' )->with( 'status' )->orderBy( 'title' )->get();
			return view( 'product.index', $data );
    }
	
    public function catalog()
    {
			$data['items'] = Product::with( 'product_type' )
				->where( 'status_id', 0 )
				->orderBy( 'title' )
				->get();
			return view( 'product.catalog', $data );
    }
	
    public function user( $id=0 )
    {
			$data['items'] = Product::with( 'product_type' )->with( 'status' )->orderBy( 'title' )->get();
			return view( 'product.user', $data );
    }

    public function admin()
    {
			$data['items'] = Product::with( 'product_type' )->with( 'status' )->orderBy( 'title' )->get();
			return view( 'product.admin', $data );
    }
	
    public function show($id)
    {
        $data = Product::with( 'product_type' )->with( 'status' )->find( $id );
        return view( 'product.show', $data );
    }

    public function create()
    {
      return view( 'product.create' );
    }

    public function store(Request $request)
    {
			$input = \Input::except( array( 'submit', '_token', '_method', 'image' ));

            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'price' => 'required',
                'status_id' => 'required',
                'product_type_id' => 'required',
                'stripe_plan_id' => 'sometimes',
            ]);

            if ($validator->fails()) {
                return back()->withInput($input)->withErrors($validator->errors());
            }

            if($input['stripe_plan_id']){
                $billing = new StripeBilling();

                $validPlan = $billing->doesPlanExists($input['stripe_plan_id']);

                if(!$validPlan){
                    $validator->getMessageBag()->add('stripe_plan_id', "Plan id do not exist on Stripe. Please make plan on Stripe.");
                    return back()->withInput($input)->withErrors($validator->errors());
                }
            }

			$data = Product::create( $input );
			$data->save();
    	return redirect( '/products/' . $data->id );
    }

    public function edit($id)
    {
        $data['item'] = Product::find( $id );
        return view( 'product.edit', $data );
    }

    public function update(Request $request, $id)
    {
		$input = \Input::except( array( 'submit', '_token', '_method', 'image' ));

        $validator = Validator::make($request->all(), [
            'stripe_plan_id' => 'sometimes',
        ]);

        if($input['stripe_plan_id']){
            $billing = new StripeBilling();

            $validPlan = $billing->doesPlanExists($input['stripe_plan_id']);

            if(!$validPlan){
                $validator->getMessageBag()->add('stripe_plan_id', "Plan id do not exist on Stripe. Please make plan on Stripe.");
                return back()->withInput($input)->withErrors($validator->errors());
            }
        }

		$record = Product::find( $id );
		foreach ( $input AS $key => $value ) {
			$record[$key] = $value;
		}
		$record->save();
    return redirect( '/products/' . $record->id );
    }

}

<?php

namespace App\Http\Controllers;

use App\Billing\StripeBilling;
use App\Company;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use \App\Order;
use Mockery\Exception;
use Validator;

class OrderController extends Controller
{
    public function index()
    {
        $user = \Auth::user();
        $orders = Order::query();

        if($user->role != "admin"){
            $orders->where('company_id', $user->company_id);
        }

        $data['orders'] =$orders->get();

        return view('order.index', $data);
    }

    public function create()
    {
        return view('order.create');
    }

    public function subscription()
    {
        return view('order.subscription');
    }

    public function products()
    {
        $subscriptionOrder = null;
        
        $user = \Auth::user();
        
        if(!empty($user->id)){
            $subscriptionOrder = \App\Order::getSubscriptionOrderForUser($user->id);
        }

        $query = Product::where('status_id', 0)
                            ->where("stripe_plan_id", "!=", "")
                            ->orderBy('title');

        if($subscriptionOrder){
            $query->where('price', ">", $subscriptionOrder->product->price )->get();
        }

        $data = [
            "subscriptions" => $query->get(),
            'subscriptionOrder' => $subscriptionOrder,
            "services" =>  Product::where('status_id', 0)->where('stripe_plan_id', '')->get(),
            "user" => $user
        ];

        return view('order.products',$data);
    }

    public function redirectToProductPage($input, $errors){
        $user = \Auth::user();
        if($user){
            return redirect()->route("orders.products")->withInput($input)->withErrors($errors);
        }else{
            return redirect()->route("orders.subscription")->withInput($input)->withErrors($errors);
        }
    }

    public function purchaseConfirmation(){
        return view('order.confirmation_after_processing_order');
    }

    public function store(Request $request)
    {
        $user = \Auth::user();
        $input =  $request->session()->pull('order');
        if(!$input){
            $input = $request->all();
        }else{
            $input = $input[0];
        }

        if($request->input("back")){
            return $this->redirectToProductPage($input,null);
        }

        if(!$user) {
            $validator = Validator::make($input, [
                'terms' => 'required',
                'subscription' => 'required',
                'stripeToken' => 'sometimes|required',
                'first_name' => 'required',
                'company_name' => 'required',
                'email' => 'required|email',
                'phone' => 'required'

            ]);
        }else{
            $validator = Validator::make($input, [
                'terms' => 'required',
                'subscription' => 'required',
                'stripeToken' => 'sometimes|required',
            ]);
        }

        $validator->setCustomMessages([
            "terms.required" => "You need to accept Terms & Conditions",
            "subscription.required" => "You need to select one subscription"
        ]);


        if ($validator->fails()) {
            return $this->redirectToProductPage($input,$validator->errors());
        }

        // Go to confirmation page
        $confirm = $request->input("confirm");
        if(is_null($confirm)) {
            $request->session()->push('order', $input);
            return view('order.confirmation_before_processing_order');
        }elseif ($confirm == 0){
            $validator->getMessageBag()->add('confirmation', "You need to confirm your order");
            return $this->redirectToProductPage($input,$validator->errors());
        }

        $company = null;
        $order = null;
        $email = null;

        if(!$user){
            $email = $input['email'];
        }else{
            $order = Order::getSubscriptionOrderForUser($user->id);
            $company = $user->company;
            $email = $user->email;
        }


        $product = Product::find($input['subscription']);
        $orderData = [
            'title' => 'Order of ' . $product->title,
            'body' => $input['body'],
            'user_id' => $user ? $user->id : null,
            'product_id' => $input['subscription'],
            'company_id' => $company ? $company->id : null,
            'status' => Order::$STATUS_PENDING,
        ];


        if(!$product->stripe_plan_id || !$order){
            $order = Order::create($orderData);
        }else{
            $order->update($orderData);
        }

        if(!$user) {
            $inputCopy = (new \ArrayObject($input))->getArrayCopy();

            unset($inputCopy["terms"]);
            unset($inputCopy["subscription"]);
            unset($inputCopy["stripeToken"]);
            unset($inputCopy["_token"]);
            unset($inputCopy["submit"]);

            $order->setGuestUserData($inputCopy);
        }

        if (isset($input['stripeToken'])){
            try {
                $order->addOrUpdateUserCard($input['stripeToken'], $email);
            } catch (\Exception $e) {
                // Card error return user to update card

                $validator->getMessageBag()->add('card', $e->getMessage());
                return $this->redirectToProductPage($input,$validator->errors());
            }
        }

        try {
            $order->submitOrderToStripe();
            // Charge is passed
            $order->sendOrderEmailToAdmins();
            if($company) {
                $company->email = $email;
                $company->save();
            }

        }catch (\Exception $e) {
            // Charge failed
            $order->sendOrderEmailToAdmins();
            $validator->getMessageBag()->add('card', $e->getMessage());
            return $this->redirectToProductPage($input,$validator->errors());
        }

        $request->session()->forget('order');
        return redirect()->route("orders.purchase-confirmation");
    }

    public function show($id)
    {
        $data = Order::find($id);
        return view('order.show', ["data"=> $data]);
    }

    public function edit($id)
    {
        $data['order'] = Order::find($id);
        return view('order.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $input = \Input::except(array('submit', '_token', '_method'));
        $record = Order::find($id);
        foreach ($input AS $key => $value) {
            $record[$key] = $value;
        }
        $record->save();
        return view('order.show', $record);
    }

}

<?php

namespace App\Billing;


use Stripe\Stripe;


class StripeBilling
{
    protected $error;

    function __construct() {
        Stripe::setApiKey(env("STRIPE_SECRET_KEY"));
    }

    public function getError()
    {
        return $this->error;
    }

    public function __call($method, $args)
    {
        $this->error = null;

        if(!method_exists($this, $method)){
            throw new Exception('Call to undefined method');
        }

        try {
            return $this->$method($args);
        } catch(\Stripe\Error\Card $e) {
            // Since it's a decline, \Stripe\Error\Card will be caught
            $this->error = $e->getMessage();
        } catch (\Stripe\Error\RateLimit $e) {
            // Too many requests made to the API too quickly
            $this->error = $e->getMessage();
        } catch (\Stripe\Error\InvalidRequest $e) {
            // Invalid parameters were supplied to Stripe's API
            $this->error = $e->getMessage();
        } catch (\Stripe\Error\Authentication $e) {
            // Authentication with Stripe's API failed
            // (maybe you changed API keys recently)
            $this->error = $e->getMessage();
        } catch (\Stripe\Error\ApiConnection $e) {
            // Network communication with Stripe failed
            $this->error = $e->getMessage();
        } catch (\Stripe\Error\Base $e) {
            // Display a very generic error to the user, and maybe send
            // yourself an email
            $this->error = $e->getMessage();
        } catch (Exception $e) {
            // Something else happened, completely unrelated to Stripe
            $this->error = $e->getMessage();
        }

        return false;
    }

    protected function createCustomer($args)
    {
        list($data) = $args;
        return \Stripe\Customer::create($data);
    }

    protected function updateCustomer($args) {

        list($customer_id, $data) = $args;

        $customer = \Stripe\Customer::retrieve($customer_id);

        if (isset($data['description'])) {
            $customer->description = $data['description'];
        }
        if (isset($data['token'])) {
            $customer->card = $data['token'];
        }
        if (isset($data['email'])) {
            $customer->email = $data['email'];
        }

        if (isset($data['coupon'])) {
            $customer->coupon = $data['coupon'];
        }

        if (isset($data['default_card'])) {
            $customer->default_card = $data['default_card'];
        }

        if (isset($data['metadata'])) {
            $customer->metadata = $data['metadata'];
        }

        return $customer->save();
    }

    protected function chargeCustomer($args)
    {
        list($stripeCostumerId, $amount, $description) = $args;

        // $amount is in dollars, convert to cents
        $amount = $amount * 100;

        $charge = \Stripe\Charge::create(array(
            'amount' => $amount,
            'currency' => 'usd',
            'customer' => $stripeCostumerId,
            'description' => $description,
        ));

        return $charge;
    }

    protected function getAllPlans(){
        return \Stripe\Plan::all();
    }

    protected function doesPlanExists($args){
        list($plan_id) = $args;

        $plans = $this->getAllPlans();
        $plan_exists = false;

        foreach ($plans->data as $plan) {
            if($plan->id == $plan_id){
                $plan_exists = true;
            }
        }

        return $plan_exists;
    }

    protected function createSubscription($args)
    {
        list($stripeCostumerId, $plan) = $args;

        $stripeSubscription = \Stripe\Subscription::create(array(
            'customer' => $stripeCostumerId,
            'plan' => $plan,
        ));

        return $stripeSubscription;
    }

    protected function switchPlan($args){
        list($subscription_id, $plan) = $args;

        $subscription = \Stripe\Subscription::retrieve($subscription_id);

        $itemID = $subscription->items->data[0]->id;

        return \Stripe\Subscription::update($subscription_id, array(
            "items" => array(
                array(
                    "id" => $itemID,
                    "plan" => $plan,
                ),
            ),
        ));
    }
}

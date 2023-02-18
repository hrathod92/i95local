<?php

namespace App;

use App\Billing\StripeBilling;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $table = 'orders';
	protected $fillable = ['title', 'body', 'user_id', 'stripe_id', 'product_id', 'status', 'notes', 'contract_ens_at', 'company_id', 'data' ];
	public $timestamps = true;

	public static $STATUS_PENDING = 'pending';
	public static $STATUS_ACTIVE = 'active';
	public static $STATUS_FINISHED = 'finished';
	public static $STATUS_FAILED = 'failed';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function company()
    {
        return $this->belongsTo('App\Company', 'company_id');
    }

    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }

    public static function getSubscriptionOrderForUser($user_id){

        return self::whereUserId($user_id)
                    ->where('stripe_id', 'regexp', '^sub_')->first();
    }

    public function getCardBrandAttribute(){
        $data = $this->data;
        if($data){
            $data = json_decode($data);
            return $data->card_brand;
        }
        return "";
    }

    public function getCardLastFourAttribute(){
        $data = $this->data;
        if($data){
            $data = json_decode($data);
            return $data->card_last_four;
        }
        return "";
    }

    public function submitOrderToStripe()
    {

        $data = json_decode($this->data);
        if(!$data){
            $data = new \stdClass();
        }

        $billing = new StripeBilling();
        $product = $this->product;

        if(!isset($data->stripe_costumer_id)){
            $data->stripe_costumer_id = Order::getLastCostumerIdForUser($this->user_id);
            $this->data = json_encode($data, JSON_PRETTY_PRINT);
            $this->save();
        }

        if ($product->stripe_plan_id){


            if($this->stripe_id && substr( $this->stripe_id, 0, 4 ) === "sub_"){
                // Switch to new plan
                $charge = $billing->switchPlan($this->stripe_id, $product->stripe_plan_id);
            }
            else {
                // subscribe to plan
                $charge = $billing->createSubscription($data->stripe_costumer_id, $product->stripe_plan_id);
            }

        }else{
            // one time charge
            $charge = $billing->chargeCustomer($data->stripe_costumer_id, $product->price, $product->title);
        }

	    if($error = $billing->getError()){
            $this->status = self::$STATUS_FAILED;
            throw new \Exception($error);
        }

        if($charge->object == "subscription"){
            $this->updateSubscriptionData($charge);
            $this->status = self::$STATUS_ACTIVE;
        }else{
            $this->status = self::$STATUS_FINISHED;
        }

        $this->stripe_id = $charge->id;

        $this->save();
    }

    public function setGuestUserData($guestData){
        $data = $this->data;

        if(!$data){
            $data = new \stdClass();
        }else{
            $data = json_decode($data);
        }

        $data->guest_user = $guestData;

        $this->data = json_encode($data, JSON_PRETTY_PRINT);
        $this->save();
    }

    public function updateSubscriptionData($subscription){
        $data = $this->data;

        if(!$data){
            $data = new \stdClass();
        }else{
            $data = json_decode($data);
        }

        $data->subscription = [
            "id" => $subscription->id,
            "stripe_customer_id" => $subscription->customer,
            "stripe_plan" => $subscription->plan->id,
            "status" => $subscription->status,
            "created" => date('Y-m-d H:i:s', $subscription->created),
            "start" => date('Y-m-d H:i:s', $subscription->start),
            "current_period_start" => date('Y-m-d H:i:s', $subscription->current_period_start),
            "current_period_end" => date('Y-m-d H:i:s', $subscription->current_period_end),
            "canceled_at" => date('Y-m-d H:i:s',  $subscription->canceled_at),
            "cancel_at_period_end" => $subscription->cancel_at_period_end,
            "ended_at" => date('Y-m-d H:i:s', $subscription->ended_at),
        ];

        $this->data = json_encode($data, JSON_PRETTY_PRINT);
        $this->save();
    }

    public function isStripeCostumerIdSet(){
        $data = $this->data;

        if(!$data){
            return false;
        }

        $data = json_decode($data);

        return isset($data->stripe_costumer_id);
    }


    public function setStripeCostumerId($stripeCostumerId){
        if(!$this->data){

            $this->data = json_encode([
                'stripe_costumer_id' => $stripeCostumerId
            ], JSON_PRETTY_PRINT);
        }else{
            $data = json_decode($this->data);
            $data->stripe_costumer_id = $stripeCostumerId;
            $this->data = json_encode($data, JSON_PRETTY_PRINT);
        }
        $this->save();
    }

    public function setCardBrand($cardBrand){
        if(!$this->data){

            $this->data = json_encode([
                'card_brand' => $cardBrand
            ], JSON_PRETTY_PRINT);
        }else{
            $data = json_decode($this->data);
            $data->card_brand  = $cardBrand;
            $this->data = json_encode($data, JSON_PRETTY_PRINT);
        }

        $this->save();
    }

    public function setCardLastFour($cardLastFour){
        if(!$this->data){

            $this->data = json_encode([
                'card_last_four' => $cardLastFour
            ], JSON_PRETTY_PRINT);
        }else{
            $data = json_decode($this->data);
            $data->card_last_four = $cardLastFour;
            $this->data = json_encode($data, JSON_PRETTY_PRINT);
        }

        $this->save();
    }


    public function addOrUpdateUserCard($stripeToken, $email){
        $billing = new StripeBilling();

        if(!$this->isStripeCostumerIdSet()){
            $costumer = $billing->createCustomer([
                'email' => $email,
                "source" => $stripeToken
            ]);
        }else{
            $data = json_decode($this->data);

            $costumer = $billing->updateCustomer($data->stripe_costumer_id, [
                "token" => $stripeToken
            ]);
        }

        if($error = $billing->getError()){
            throw new \Exception($error);
        }else{
            $this->setStripeCostumerId($costumer->id);
            $this->setCardBrand($costumer->sources->data[0]->brand);
            $this->setCardLastFour($costumer->sources->data[0]->last4);
        }

    }

    public static function getLastCostumerIdForUser($userId){
         $order = self::where('user_id', $userId)->where('data', 'LIKE', "%stripe_costumer_id%")->first();

         if($order){
             return json_decode($order->pluck('data'))->stripe_costumer_id;
         }

         return null;
    }

    public function sendOrderEmailToAdmins(){

        \Mail::send('emails.order_notification', ['order' => $this], function ($message)
        {
            $from = trim(Setting::whereSlug("contact-email-from")->first()->body);
            $to = trim(Setting::whereSlug("contact-email-to")->first()->body);
            $cc = trim(Setting::whereSlug("contact-email-cc")->first()->body);

            $message->from($from)
                    ->to($to)
                    ->cc($cc)
                    ->subject('Order notification');
        });
    }

}

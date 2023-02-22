<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use \App\Order;
use \App\Transaction;
use \App\TransactionItem;
use \App\Product;
use \App\User;
use DB;

class EmailController extends Controller
{
    public function __construct() 
    {
        $this->middleware( 'auth', [ 'except' => [ 'index', 'show' ]]);
        //$this->middleware( 'role:admin', [ 'except' => [ 'index', 'show' ]]);
        //// $this->beforeFilter( 'csrf', array( 'on'=>'post' ));
    }
	
    public function orderReminder()
    {
        //7 Day Reminder
        $orders = Order::whereRaw("reoccuring = 1 AND DAY(NOW()) = DAY(DATE_SUB(STR_TO_DATE(CONCAT(day_of_reoccuring,',',MONTH(NOW()),',',YEAR(NOW())),'%d,%m,%Y'), INTERVAL 7 DAY))")->get();
        
        foreach($orders as $order)
        {
            $users = User::where('role','=','sales')->whereHas('accounts', function($q) use ($order)
            {
                $q->where('id', '=', $order->account_id);
            })->get();
            
            $accountName = \App\Account::find($order->account_id)->first()->title;
            
            foreach($users as $user)
            {
                \Mail::send('emails.order_reminder_sales', ['user' => $user,'account_name' => $accountName], function ($m) use ($user) 
        		{
        			$m->from('info@floorcoexpress.com', 'Floorco');
        
        			$m->to($user->email, $user->first_name.' '.$user->last_name)->subject('Order Reminder');
        		});
            }
            
            $users = User::whereRaw("(role = 'account' OR role = 'buyer')")->whereHas('accounts', function($q) use ($order)
            {
                $q->where('id', '=', $order->account_id);
            })->get();
            
            foreach($users as $user)
            {
                \Mail::send('emails.order_reminder', ['user' => $user,'account_name' => $accountName], function ($m) use ($user) 
        		{
        			$m->from('info@floorcoexpress.com', 'Floorco');
        
        			$m->to($user->email, $user->first_name.' '.$user->last_name)->subject('Order Reminder');
        		});
            }
        }
        
        //14 Day Reminder
        $orders = Order::whereRaw("reoccuring = 1 AND DAY(NOW()) = DAY(DATE_SUB(STR_TO_DATE(CONCAT(day_of_reoccuring,',',MONTH(NOW()),',',YEAR(NOW())),'%d,%m,%Y'), INTERVAL 14 DAY))")->get();
        
        foreach($orders as $order)
        {
            $users = User::where('role','=','sales')->whereHas('accounts', function($q) use ($order)
            {
                $q->where('id', '=', $order->account_id);
            })->get();
            
            $accountName = \App\Account::find($order->account_id)->first()->title;
            
            foreach($users as $user)
            {
                \Mail::send('emails.order_reminder_sales', ['user' => $user,'account_name' => $accountName], function ($m) use ($user) 
        		{
        			$m->from('info@floorcoexpress.com', 'Floorco');
        
        			$m->to($user->email, $user->first_name.' '.$user->last_name)->subject('Order Reminder');
        		});
            }
            
            $users = User::whereRaw("(role = 'account' OR role = 'buyer')")->whereHas('accounts', function($q) use ($order)
            {
                $q->where('id', '=', $order->account_id);
            })->get();
            
            foreach($users as $user)
            {
                \Mail::send('emails.order_reminder', ['user' => $user,'account_name' => $accountName], function ($m) use ($user) 
        		{
        			$m->from('info@floorcoexpress.com', 'Floorco');
        
        			$m->to($user->email, $user->first_name.' '.$user->last_name)->subject('Order Reminder');
        		});
            }
        }
    }
	
		
	
}

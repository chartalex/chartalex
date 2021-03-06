<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Cart;
use App\User;
use App\Product;
use App\Order;
use App\OrderDetails;
use App\Http\Requests;
use Config;
use App\EmailLogin;
use Mail;

class OrderController extends Controller
{


    public function index()
    {
        $admin_email = env('ADMIN_EMAIL'); // run php artisan cache:clear to work properly

        if (Auth::check()) {
            // The user is logged in...
            $email = Auth::user()->email;

            if ($email == $admin_email) {
                
                $orders = Order::orderBy('created_at', 'desc')->get();
                $user = Auth::user();

                return view('mclh.orders-admin', array(
                    'orders' => $orders
                ));

            } else {
                $orders = Order::where('email', $email)->orderBy('created_at', 'desc')->get();
                $user = Auth::user();

                return view('mclh.orders', array(
                    'orders' => $orders
                ));
            }
        } else {
            return redirect('/auth/login')->with('info','You must be logged to see your previous orders.');
        }

 
    }

    public function show($id)
    {

        $order = Order::find($id);
        $order_details = OrderDetails::where('order_id', $id)->join('products', 'order_details.product_id', '=', 'products.id')->get();

        if (Auth::check()) {
        // The user is logged in...
            if (Auth::user()->id == $order->user_id OR Auth::user()->email == env('ADMIN_EMAIL')) {

                return view('mclh.order', array(
                    'order' => $order,
                    'order_details' => $order_details
                ));
            } else {
                return redirect('/mclh/order');
            }
        } else {
            return redirect('/auth/login')->with('info','You must be logged to see your previous orders.');
        }


    }

    public function store(Request $request)
    {
    	$shipping_fees = 5;

    	$this->validate($request, [
	        'email' => 'required|email',
	        'shipto_firstname' => 'required',
	        'shipto_lastname' => 'required',
	        'shipto_street' => 'required',
	        'shipto_street2' => 'string',
	        'shipto_zip' => 'required',
	        'shipto_city' => 'required',
	        'shipto_lastname' => 'required',
    	]);

    	$amount = Cart::total() + $shipping_fees;

        $shipto_firstname = $request->input('shipto_firstname');
        $shipto_lastname = $request->input('shipto_lastname');
        $shipto_street = $request->input('shipto_street');
        $shipto_street2 = $request->input('shipto_street2');
        $shipto_zip = $request->input('shipto_zip');
        $shipto_city = $request->input('shipto_city');
        $shipto_country = $request->input('shipto_country');

		$token = $request->input('stripeToken');
        $email = $request->input('email');
        $emailCheck = User::where('email', $email)->value('email');

        \Stripe\Stripe::setApiKey(env('STRIPE_SK'));

        // If the email doesn't exist in the database create new customer and user record
        if (!isset($emailCheck)) {
            // Create a new Stripe customer
            try {
                $customer = \Stripe\Customer::create([
                'source' => $token,
                'email' => $email,
                ]);
            } catch (\Stripe\Error\Card $e) {
                return redirect()->route('order')
                    ->withErrors($e->getMessage())
                    ->withInput();
            }

            $customerID = $customer->id;

            // Create a new user in the database with Stripe
            $user = User::create([
            'email' => $email,
            'stripe_customer_id' => $customerID,
            ]);
        } else {
            // email exists in database

            // stripe_customer_id exists in database
            if (!empty(User::where('email', $email)->value('stripe_customer_id')) ) {
                $customerID = User::where('email', $email)->value('stripe_customer_id');
            } else {
                // Create a new Stripe customer if null
                try {
                    $customer = \Stripe\Customer::create([
                    'source' => $token,
                    'email' => $email,
                    ]);
                } catch (\Stripe\Error\Card $e) {
                    return redirect()->route('order')
                        ->withErrors($e->getMessage())
                        ->withInput();
                } 

                $customerID = $customer->id;
                // Fill blank stripe_customer_id
                $user = User::where('email', $email)->update([ 'stripe_customer_id' => $customerID ]);
            }
            $user = User::where('email', $email)->first();
        }

        // Charging the Customer with the selected amount
        try {
            $charge = \Stripe\Charge::create([
                'amount' => $amount*100,
                'currency' => 'eur',
                'customer' => $customerID,
                ]);
        } catch (\Stripe\Error\Card $e) {
            return redirect()->route('order')
                ->withErrors($e->getMessage())
                ->withInput();
        }

        // Create order record in the database
        $order = Order::create([
	            'user_id' => $user->id,
	            'amount' => $amount,
	            'shipping_fees' => 5,
	            'email' => $email,
	            'shipto_firstname' 	=> $shipto_firstname,
	            'shipto_lastname' 	=> $shipto_lastname,
	            'shipto_street' 	=> $shipto_street,
	            'shipto_street2' 	=> $shipto_street2,
	            'shipto_zip' 		=> $shipto_zip,
	            'shipto_city' 		=> $shipto_city,
	            'shipto_country' 	=> $shipto_country,
	            'stripe_transaction_id' => $charge->id
	        ]);

        // Create order DETAILS record in the database

		$cart = Cart::content();

		foreach ($cart as $item) {
		    OrderDetails::create([
		        'order_id' => $order->id,
		        'product_id' => $item->id,
		        'qty' => $item->qty,
		    ]);
        }

        Cart::destroy();

        // Send email confirmation
        $emailLogin = EmailLogin::createForEmail($request->input('email'));

        $url = route('auth.email-authenticate', [
            'token' => $emailLogin->token
        ]);

        Mail::send('mclh.emails.email-order-success', ['url' => $url], function ($m) use ($request) {
        $m->from('mclh@chartalex.fr', 'M. Chat L\'Heureux');
        $m->to($request->input('email'))->subject('Order success');
        });

        return redirect('mclh/order-success');
    }
}

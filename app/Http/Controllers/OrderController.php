<?php

namespace App\Http\Controllers;

use Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Order;
use App\Basket;
use App\Helper\Helper;
use Auth;
use Redirect;
use Session;
use Validator;
use Carbon;

class OrderController extends Controller
{
    private $custom_errors;
    private $addresses;
    private $order;

    /**
     * Initalize the middleware + set the user addresses if it has one
     */
    public function __construct()
    {
        $this->middleware('auth');

        if(Auth::check()){
            $this->addresses = Auth::user()->addresses;
            $this->postTransaction(Session::get('basket_id'));
        }
    }

    public function getIndex(){}

    /**
     * Gets the current basket modell
     * @return Basket Instance of Basketmodel
     */
    public function getCurrentBasket()
    {
        return Basket::findOrFail( Session::get('basket_id') );
    }

    /**
     * Gets the current order modell from the basket
     * @return Order Instance of Ordermodel
     */
    public function getCurrentOrder()
    {
        $basket = $this->getCurrentBasket();
        $order = $basket->order;

        return $order;
    }

    /**
     * Loads the current chooseAddress View
     * @return view
     */
    public function getChooseAddress()
    {
        $order = $this->getCurrentOrder();

        return view('orders.chooseAddress')
            ->with('addresses', $this->addresses)
            ->with('order', $order)
            ->with('custom_errors', $this->custom_errors);
    }

    /**
     * Checks the input from the chooseAddress view.
     * When invalid input it will return back with messages
     * else it will redirect to choosePaymentMethod
     *
     */
    public function postChooseAddress()
   {
        $request = Request::all();
        $order = $this->getCurrentOrder();

        $validator = Validator::make($request,
            ['optionDeliveryAddress' => 'required'],
            ['optionBillingAddress' => 'required']
        );

        if($validator->passes())
        {
            $order->address_id = $request['optionDeliveryAddress'];
            $order->billing_id = $request['optionBillingAddress'];
            $order->save();

            return redirect('orders/choose-payment-method');

        } else {
            return view('orders.chooseAddress')
              ->with('addresses', $this->addresses)
              ->with('order', $order)
              ->withErrors($validator);
        }
    }

    /**
     * Loads the current choosePaymentMethod View
     * @return view
     */
    public function getChoosePaymentMethod()
    {    
        $order = $this->getCurrentOrder();

        return view('orders.choosePaymentMethod')
          ->with('payment_methods', $this->addresses);
    }

    /**
     * Checks the input from the choosePaymentMethod view.
     * When invalid input it will return back with messages
     * else it will redirect to lastCheckAndBuy
     *
     */
    public function postChoosePaymentMethod()
    {
        $request = Request::all();  
        $order = $this->getCurrentOrder();
        $order->payment_method = $request['optionPaymentMethod'];
        $order->save();

        return redirect('orders/checkout');
    }

    /**
     * Loads the current lastCheckAndBuy View
     * and prepares some data for it
     * @return view 
     */
    public function getCheckout()
    {
        $basket = $this->getCurrentBasket();
        $order = $this->getCurrentOrder();
        $payment_method = '';
        $billing_address = '';

        switch ($order->payment_method) {
            case '1':
            $payment_method = 'Vorkasse'; break;
            case '2':
            $payment_method = 'Nachnahme'; break;
            case '3':
            $payment_method = 'Lastschrift'; break;
            case '4':
            $payment_method = 'Paypal'; break;
            case '5':
            $payment_method = 'Kreditkarte'; break;
        }

        if($order->billing_id == 0)
            $billing_address = $order->address;
        else
            $billing_address = $order->billing;

        return view('orders.lastCheckAndBuy')
              ->with('custom_errors', $this->custom_errors)
              ->with('order', $basket->order)
              ->with('articles', $basket->articles)
              ->with('delivery_address', $order->address)
              ->with('billing_address', $billing_address)
              ->with('payment_method', $payment_method); 
    }

    /**
     * First it checks for an valid coupon-code if exist then
     * it checks a last time if all articles are in stock
     * 
     * If true 
     *     then update some data in order and basket 
     *     after that create a new one here (it is not the right place ;) we know
     *
     * If false
     *     then redirect back to the basket 
     * @return redirect
     */
    public function postCheckout()
    {
        $request = Request::all();

        if(isset($request['coupon']))
            ;// check coupon code

        $basket = $this->getCurrentBasket();
        $order = $this->getCurrentOrder();

        if(Helper::inStock()){
            // If everything is successful than we can set basket purchasedate and order status
            // check if enough articles are there
            // subtract all articles

            foreach ($basket->articles as $article) {
                $article->quantity -= $article->pivot->quantity;
                $article->save();
            }

            $basket->purchaseDate = Carbon\Carbon::now();
            $basket->active = 0;
            $order->status = 1;
            $basket->save();
            $order->save();
            
            // Create a new basket here
            $basket = new Basket();
            $basket->user_id = 0;
            $basket->session_id = Session::getId();
            $basket->total_price = 0;
            $basket->total_quantity = 0;
            $basket->active = 1;
            $basket->save();

            // Set the new id in the session
            Session::put('basket_id', $basket->id);

            return redirect('orders/success');

        } else {
            return redirect('baskets');
        }
    }

    /**
     * Loads the current success view 
     * @return view
     */
    public function getSuccess()
    {
        return view('orders.success');
    }

    /**
     * Checks the basket model for a valid order + articles in basket
     * 
     * If no order
     *     then create a new one and assign it to the class variable
     * Else
     *     assign the basket order to the local variable
     *     
     * @param  integer  $basket_id   id of the basket
     */
    public function postTransaction($basket_id)
    {
        $basket = Basket::findOrFail($basket_id);

        // Check if the basket is empty redirect to home
        if(!$basket->hasArticles())
            return redirect('/');

        // Check if the cart has assigend an order tupel 
        if( !$basket->hasOrder() ) {

            // This basket has no order before..we create a new and assign it to the basket
            $order = new Order();
            $order->user_id = Auth::user()->id;
            $order->basket_id = $basket->id;
            $order->save();
            $this->order = $order;

        } else 
            $this->order = $basket->order;
    }

    /**
     * Checks the users basket and fill the custom errors array
     * @param  integer $basket_id   ID from the basket
     * @return bool  valid order or not
     */
    public function check($basket_id)
    {
        $order = Basket::findOrFail($basket_id)->order;

        if(!$order->address_id)
            $this->custom_errors[] = 'You must choose a delivery address.';

        if(!$order->billing_id)
            $this->custom_errors[] = 'You must choose a billing address.';

        if(!$order->payment_method)
            $this->custom_errors[] = 'You must choose a valid payment method.';

        /*if($order->coupon_code){
          if($this->checkCouponCode())
           ;// valid code todo
          else
            $this->custom_errors[] = 'Your coupon code is invalid.';
        }*/

        if(empty($this->custom_errors))
            return true;
        else
            return false;
    }
}

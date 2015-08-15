<?php

namespace App\Http\Controllers;

use Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Order;
use App\Basket;
use Auth;
use Redirect;
use Session;
use Validator;

class OrderController extends Controller
{
  private $custom_errors;
  private $addresses;
  private $order;

  /**
   * Initalize the middleware
   */
  public function __construct()
  {
    $this->middleware('auth');

    if(Auth::check()){
      $this->addresses = Auth::user()->addresses;
      $this->postTransaction(Session::get('basket_id'));
    }
  }

  public function getIndex()
  {
      //
  }

  public function getCurrentBasket()
  {
    return Basket::findOrFail( Session::get('basket_id') );
  }

  public function getCurrentOrder()
  {
    $basket = $this->getCurrentBasket();
    $order = $basket->order;

    return $order;
  }

  /**
   * Will return the chooseAddress view
   * @return view
   */
  public function getChooseAddress()
  {
    $order = $this->getCurrentOrder();

    // check for a address before
    // cause user without one address should be redirected to create a address

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

      if($request['optionBillingAddress'] == 0)
        $order->billing_id = $order->address_id;
      else
        $order->billing_id = $request['optionBillingAddress'];

      $order->save();

      return redirect('orders/choose-payment-method');
    
    }else{
      return view('orders.chooseAddress')
          ->with('addresses', $this->addresses)
          ->with('order', $order)          
          ->withErrors($validator);
    }
  }

  public function getChoosePaymentMethod()
  {    
    $order = $this->getCurrentOrder();

    return view('orders.choosePaymentMethod')
          ->with('payment_methods', $this->addresses);
  }

  public function postChoosePaymentMethod()
  {
    $request = Request::all();    
    // Todo;: check the input
    //dd($request);
    //
    return redirect('orders/checkout');     
  }

  public function getCheckout()
  {
    $basket = $this->getCurrentBasket();
    $order = $this->getCurrentOrder();

    return view('orders.checkout')
          ->with('custom_errors', $this->custom_errors)
          ->with('order', $basket->order)
          ->with('products', $basket->products)
          ->with('addresses', $this->addresses); 
  }

  public function postTransaction($basket_id)
  {
    $basket = Basket::findOrFail($basket_id);

    // Check if the basket is empty
    if(!$basket->hasProducts())
      return Redirect::back();

    // Check if the cart has an order tupel assigend
    if($basket->hasOrder()) {

      // This basket has no order before..we create a new and assign it to the basket
      $order = new Order();
      $order->user_id = Auth::user()->id;
      $order->basket_id = $basket->id;
      $order->save();
      $this->order = $order;
      // redirect the customer to the order form site
      //return redirect('orders/check');

    } else {
      $this->order = $basket->order;
      //dd('Ich habe bereits eine Order zugewiesen bekommen');
      // Check the order data for for nessesary data
      // First check the address of the user make the current one as standard address
      // The same with the billing address
      // But give the customer a chance to change his address
      // Next the customer must choose a valid payment method
      // If the user got a coupon-code then validate it
      /*$success = $this->check($basket_id);
      
      if($success)
        return view('orders/success');
      else
        return view('orders/checkout')
          ->with('custom_errors', $this->custom_errors)
          ->with('order', $basket->order)
          ->with('products', $basket->products)
          ->with('addresses', Auth::user()->addresses);  */
    }
    //Order::findOrNew($id)
    //return view('order.transaction');
  }

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
    //dd(empty($custom_error));
    if(empty($this->custom_errors))
      return true;
    else
      return false;
  }
}

<?php

namespace App\Http\Controllers;

use Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Order;
use App\Basket;
use Auth;
use Redirect;

class OrderController extends Controller
{
  private $custom_errors;
  
  public function getIndex()
  {
      //
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

      // redirect the customer to the order form site
      return redirect('orders/check');

    } else {
      //dd('Ich habe bereits eine Order zugewiesen bekommen');
      // Check the order data for for nessesary data
      // First check the address of the user make the current one as standard address
      // The same with the billing address
      // But give the customer a chance to change his address
      // Next the customer must choose a valid payment method
      // If the user got a coupon-code then validate it
      $success = $this->check($basket_id);
      
      if($success)
        return view('orders/success');
      else
        return view('orders/checkout')
          ->with('custom_errors', $this->custom_errors)
          ->with('products', $basket->products);  
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

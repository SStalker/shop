<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [];

    public static $rules = [
    	'user_id' => 'required',
    	'address_id' => 'required',
    	'billing_id' => 'required',
    	'basket_id' => 'required',
    	'payment_method' => 'required',
    	'status' => 'required'
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function address()
    {
    	return $this->belongsTo('App\Address');
    }
    
    public function billing()
    {
    	return $this->belongsTo('App\Address');
    }

    public function basket()
    {
    	return $this->belongsTo('App\Basket');
    }
}

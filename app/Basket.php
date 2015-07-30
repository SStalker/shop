<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    protected $fillable = [
        'user_id',
        'session_id',
        'total_price',
        'total_quantity',
        'active'
    ];

    public function products()
    {
    	return $this->belongsToMany('App\Product')->withPivot('quantity', 'price')->withTimestamps();
    }

    public function order()
    {
        return $this->hasOne('App\Order');
    }

    public function hasProducts()
    {
        return !$this->products->isEmpty();
    }

    public function hasOrder()
    {
        return $this->order == null;
    }

    /*public static $rules = [    	
        'total_price' => 'required',
        'total_quantity' => 'required',
        'active' => 'required'
    ];*/
}

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

    public function articles()
    {
    	return $this->belongsToMany('App\Article')->withPivot('quantity', 'price')->withTimestamps();
    }

    public function order()
    {
        return $this->hasOne('App\Order');
    }

    public function hasArticles()
    {
        return !$this->articles->isEmpty();
    }

    public function hasOrder()
    {
        return ($this->order != null);
    }

    /*public static $rules = [    	
        'total_price' => 'required',
        'total_quantity' => 'required',
        'active' => 'required'
    ];*/

    /*  Todo: Change all $total_price appearance from money_format('%.2n', $basket->total_price) to $basket->total_price
    */
    public function getTotalPriceAttribute($total_price)
    {
        return money_format('%.2n', $total_price);
    }
}

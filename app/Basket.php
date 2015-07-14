<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    protected $fillable = [
        'customer_id',
        'total_price',
        'total_quantity',
        'active'
    ];

    public function products()
    {
    	return $this->belongsToMany('App\Product')->withTimestamps();
    }

    /*public static $rules = [    	
        'total_price' => 'required',
        'total_quantity' => 'required',
        'active' => 'required'
    ];*/
}
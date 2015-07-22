<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use App\Basket;

class BasketController extends Controller
{
	public function __construct()
	{
		$this->middleware('basket');
	}

    public function getIndex()
    {	$basket_id = Session::get('basket_id');
    	$products = Basket::findOrFail($basket_id)->products;

    	return view('baskets.index')
    			->with('products', $products);
    }
}

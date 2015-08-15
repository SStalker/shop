<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;
use App\Product;

class StartController extends Controller
{
	public function __construct()
	{
		$this->middleware('basket');
	}
	
    public function getIndex()
    {    	
    	$categories = Category::all();

        //Get the 6 most ordered products
        $productsAsc = Product::orderBy('times_ordered','asc')->get();
        $products = array();
        for($i = 0; $i < 6; $i++ ){
            $products[] = $productsAsc[$i];
        }

        //return all categories for side menu and 6 most ordered products
    	return view('index')
    		->with('categories', $categories)
            ->with('products', $products);
    }
}

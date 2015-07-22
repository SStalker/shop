<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use App\Basket;
use App\Product;

class BasketController extends Controller
{
    private $id;

	public function __construct()
	{
		$this->middleware('basket');
        $this->id = Session::get('basket_id');
	}

    public function getIndex()
    {
        $basket = Basket::findOrFail($this->id);
        $products = $basket->products;

            return view('baskets.index')
                ->with('basket', $basket)
                ->with('products', $products);
    }

    public function postAddProduct($product_id)
    {
        // Update a already inserted product
        // Example: User::find(1)->roles()->updateExistingPivot($roleId, $attributes);

        $product = Product::findOrFail($product_id);
        $basket = Basket::findOrFail($this->id);

        if($basket->products()->find($product_id)) {

            //dd('This product is already in the basket. Update it.');
            $basket->products()->updateExistingPivot($product_id, ['quantity' => $product->quantity, 'price' => $product->price]);

        } else{

            //dd('This product is not in the basket. Simply add it.');
            $basket->products()->attach($product_id, ['quantity' => $product->quantity, 'price' => $product->price]);
        }

        return redirect('baskets/index');
    }

    public function postOrder()
    {
        // todo
    }

    public function postDeleteProduct($product_id)
    {
        $basket = Basket::findOrFail($this->id);
        $basket->products()->detach($product_id);

        return redirect('baskets/index');
    }
}

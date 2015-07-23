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

    /**
     * This function add/update a product with the given id
     * @param  integer $product_id ID of the product
     * @return redirect to basket/index
     */
    public function postAddProduct($product_id)
    {
        // Update a already inserted product
        // Example: User::find(1)->roles()->updateExistingPivot($roleId, $attributes);

        $product = Product::findOrFail($product_id);
        $basket = Basket::findOrFail($this->id);
        $productsOfBasket = $basket->products();

        if($productsOfBasket->find($product_id)) {

            //dd('This product is already in the basket. Update it.');
            $productsOfBasket->updateExistingPivot($product_id, ['quantity' => 1, 'price' => $product->price]);

        } else {

            //dd('This product is not in the basket. Simply add it.');
            $productsOfBasket->attach($product_id, ['quantity' => 1, 'price' => $product->price]);
            //  change the baskets price and quantity
            $basket->total_price += $product->price;
            $basket->total_quantity += 1;
            $basket->update();
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
        $productsOfBasket = $basket->products();
        $productMN = $productsOfBasket->find($product_id)->pivot;
        //dd($productMN->pivot->price);
        // change the baskets price and quantity
        
        $basket->total_price -= $productMN->quantity * $productMN->price;
        $basket->total_quantity -= $productMN->quantity;
        $basket->save();

        $productsOfBasket->detach($product_id);        

        return redirect('baskets/index');
    }
}

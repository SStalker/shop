<?php

namespace App\Http\Controllers;

use Request;
use Input;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use App\Basket;
use App\Article;

class BasketController extends Controller
{
    private $id;
    private $quantity_errors;

	public function __construct()
	{
		$this->middleware('basket');
        $this->id = Session::get('basket_id');
	}

    public function getIndex()
    {
        $basket = Basket::findOrFail($this->id);
        $articles = $basket->articles;

        return view('baskets.index')
            ->with('basket', $basket)
            ->with('articles', $articles)
            ->with('invalidArticle', $this->inStock())
            ->with('quantity_errors', $this->quantity_errors);
    }

    /**
     * This function add/update a article with the given id
     * @param  integer $article_id ID of the article
     * @return redirect to basket/index
     */
    public function postAddArticle($article_id)
    {
        //If user is guest redirect to Login, this is because of a lack of time.
        if(!Auth::check()){
            return redirect('auth/login');
        }

        // Update a already inserted article
        // Example: User::find(1)->roles()->updateExistingPivot($roleId, $attributes);

        $article = Article::findOrFail($article_id);
        $basket = Basket::findOrFail($this->id);
        $articlesOfBasket = $basket->articles();

        if($articlesOfBasket->find($article_id)) {

            //dd('This article is already in the basket. Update it.');
            // Thinking... this would override the previous quantity..not good
            $quantityInBasket = $articlesOfBasket->find($article_id)->pivot->quantity + 1;
            $articlesOfBasket->updateExistingPivot($article_id, ['quantity' => $quantityInBasket, 'price' => $article->price]);
            $basket->total_price += $article->price;
            $basket->total_quantity += 1;
            $basket->update();

        } else {

            //dd('This article is not in the basket. Simply add it.');
            $articlesOfBasket->attach($article_id, ['quantity' => 1, 'price' => $article->price]);
            //  change the baskets price and quantity
            $basket->total_price += $article->price;
            //dd($basket->total_price);
            $basket->total_quantity += 1;
            $basket->update();
        }

        return redirect('baskets/index');
    }

    public function postOrder()
    {
        // todo
    }

    public function postDeleteArticle($article_id)
    {
        $basket = Basket::findOrFail($this->id);
        $articlesOfBasket = $basket->articles();
        $articleMN = $articlesOfBasket->find($article_id)->pivot;
        //dd($articleMN->pivot->price);
        // change the baskets price and quantity
        
        $basket->total_price -= $articleMN->quantity * $articleMN->price;
        $basket->total_quantity -= $articleMN->quantity;
        $basket->save();

        $articlesOfBasket->detach($article_id);        

        return redirect('baskets/index');
    }

    public function postChangeQuantity($article_id)
    {
        //dd(Request::all());
        $article = Article::findOrFail($article_id);
        $basket = Basket::findOrFail($this->id);
        $articlesOfBasket = $basket->articles();
        if(Input::get('quantity') > $article->quantity) {
            $articlesOfBasket->updateExistingPivot($article_id, ['quantity' => $article->quantity]);
        }else {
            $articlesOfBasket->updateExistingPivot($article_id, ['quantity' => Input::get('quantity')]);
        }
        $this->recalcCart();
        return redirect('baskets/index');
    }

    private function recalcCart()
    {
        $basket = Basket::findOrFail($this->id);
        $articlesOfBasket = $basket->articles;
        $total_quantity = 0;
        $total_price = 0;

        foreach ($articlesOfBasket as $article) {
            $total_quantity += $article->pivot->quantity;
            $total_price += $article->pivot->quantity*$article->pivot->price;
        }

        $basket->total_quantity = $total_quantity;
        $basket->total_price = $total_price;
        $basket->save();
    }

    private function inStock()
    {
        $basket = Basket::findOrFail($this->id);
        $articles = $basket->articles;
        $b_error = false;

        foreach ($articles as $article) {
            if(!$article->status){

                $this->quantity_errors[] = 'Artikel "' .$article->name. '" ist nicht auf Lager.';
                $b_error = true;
            }else if( ($article->quantity-$article->pivot->quantity) < 0 ) {
                $this->quantity_errors[] = 'Leider nicht mehr genug Artikel auf Lager.';
                $b_error = true;
            }
        }
        
        return $b_error;
    }
}

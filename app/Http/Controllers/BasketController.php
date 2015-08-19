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

    /**
     * This function returns an index page
     * @param
     * @return view basket.index with a basket object, an article array,
     *          an array of articles not available and an errr object
     */

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
        $article = Article::findOrFail($article_id);        
        $basket = Basket::findOrFail($this->id);
        $articlesOfBasket = $basket->articles();
        
        //Update a already inserted article
        if($articlesOfBasket->find($article_id)) {

            //Quantity in basket raised by one
            $quantityInBasket = $articlesOfBasket->find($article_id)->pivot->quantity + 1;

            //Update the basket and pivot table
            $articlesOfBasket->updateExistingPivot($article_id, ['quantity' => $quantityInBasket]);
            $basket->total_price += $article->price;
            $basket->total_quantity += 1;
            $basket->update();

        }
        //Add new article to basket
        else
        {
            //Attach new article and update basket
            $articlesOfBasket->attach($article_id, ['quantity' => 1, 'price' => $article->price]);
            $basket->total_price += $article->price;
            $basket->total_quantity += 1;
            $basket->update();
        }

        return redirect('baskets/index');
    }

    /**
     * This function deletes an article from basket
     *
     * @param integer $article_id ID of the article
     * @return redirect to basket/index
     *
     */
    public function postDeleteArticle($article_id)
    {
        $basket = Basket::findOrFail($this->id);
        $articlesOfBasket = $basket->articles();
        $articleMN = $articlesOfBasket->findOrFail($article_id)->pivot;

        //Change the baskets total price and quantity
        $basket->total_price -= $articleMN->quantity * $articleMN->price;
        $basket->total_quantity -= $articleMN->quantity;
        $basket->save();

        //Detach article from basket
        $articlesOfBasket->detach($article_id);        

        return redirect('baskets/index');
    }

    /**
     * This function changes the quantity of one given article
     *
     * @param integer $article_id ID of the article
     * @return redirect to basket/index
     * */

    public function postChangeQuantity($article_id)
    {
        $article = Article::findOrFail($article_id);
        $basket = Basket::findOrFail($this->id);
        $articlesOfBasket = $basket->articles();

        //If article quantity is set to 0 remove it from the basket
        if(Input::get('quantity') == 0){
            $this->postDeleteArticle($article_id);

        }
        else
        {
            //check if the wanted amount of one article is available
            if(Input::get('quantity') > $article->quantity) {
                $articlesOfBasket->updateExistingPivot($article_id, ['quantity' => $article->quantity]);
            }else {
                $articlesOfBasket->updateExistingPivot($article_id, ['quantity' => Input::get('quantity')]);
            }
        }
        $this->recalcCart();
        return redirect('baskets/index');
    }

    /**
     * This function calculates quantity and total_price of the basket
     *
     * @param
     * @return void
     *
     * */
    private function recalcCart()
    {
        $basket = Basket::findOrFail($this->id);
        $articlesOfBasket = $basket->articles;
        $total_quantity = 0;
        $total_price = 0;

        //Adds up the quantity and prices of all articles in the basket
        foreach ($articlesOfBasket as $article) {
            $total_quantity += $article->pivot->quantity;
            $total_price += $article->pivot->quantity*$article->pivot->price;
        }

        //Update the basket
        $basket->total_quantity = $total_quantity;
        $basket->total_price = $total_price;
        $basket->save();
    }

    /*
     * This function checks if an article is available or if wanted number is available
     *
     * @param
     * @return boolean $b_error if error appears
     *
     */
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

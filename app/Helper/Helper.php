<?php 
namespace App\Helper;

use Session;
use App\Basket;

class Helper{
 	
	/**
	 * This function should check the articles in the users basket 
	 * @return bool in stock or not
	 */
 	public static function inStock() {
 
        $basket = Basket::findOrFail(Session::get('basket_id'));
        $articles = $basket->articles;
        
        foreach ($articles as $article) {
            if(!$article->status || ($article->quantity - $article->pivot->quantity) < 0)
                return false;            
        }
        
        return true;
    }
 
}
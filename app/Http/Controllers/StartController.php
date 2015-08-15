<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;
use App\Article;

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
        $articlesAsc = Article::orderBy('times_ordered','asc')->get();
        $articles = array();
        for($i = 0; $i < 6; $i++ ){
            $articles[] = $articlesAsc[$i];
        }

        //return all categories for side menu and 6 most ordered articles
    	return view('index')
    		->with('categories', $categories)
            ->with('articles', $articles);
    }
}

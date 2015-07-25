<?php

namespace App\Http\Controllers;

use App\Product;

use Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function getSearch()
    {
        $input = '%'.Request::input('search').'%';
        $products = Product::where('name', 'LIKE', $input)
            ->orWhere('description', 'LIKE', $input)
            ->get();
        return view('search.result')->with('products', $products);
    }
}

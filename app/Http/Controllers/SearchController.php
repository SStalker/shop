<?php

namespace App\Http\Controllers;

use App\Article;

use Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function getSearch()
    {
        $input = '%'.Request::input('searchtext').'%';
        $articles = Article::where('name', 'LIKE', $input)
            ->orWhere('description', 'LIKE', $input)
            ->get();
        return view('search.result')->with('articles', $articles);
    }
}

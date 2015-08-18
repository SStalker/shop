<?php

namespace App\Http\Controllers;

use App\Article;

use Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    /**
     * This function searches for an input search text in the articles table columns name and description
     *
     * @param
     * @return View search.result with articles array of all found articles
     *
     * */
    public function getSearch()
    {
        $input = '%'.Request::input('searchtext').'%';
        $articles = Article::where('name', 'LIKE', $input)
            ->orWhere('description', 'LIKE', $input)
            ->where('deleted_at', 'LIKE', '')
            ->get();
        return view('search.result')->with('articles', $articles);
    }
}

<?php

namespace App\Http\Controllers;

use App\Category;
use App\Article;
use App\User;

use Request;
use Validator;
use Auth;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except'=> [ 'show']]);
        $this->middleware('admin', ['except' => ['show']]);
        $this->middleware('basket');
    }

    /**
     * Display a listing of all articles for administration purposes.
     *
     * @return View articles.list with all articles
     */
    public function index()
    {
        $articles = Article::all();

        return view('articles.list')->with('articles', $articles);
    }

    /**
     * Show the form for creating a new article.
     *
     * @return View articles.create with an array of all categories or redirect to startpage
     */
    public function create()
    {

        if(Auth::user()->hasRole('admin'))
        {
            $categoryArray = Category::orderBy('name', 'asc')->get();
            $categories = array('0' => '--- bitte wählen ---');
            foreach($categoryArray as $category)
            {
                $categories[$category->id] = $category->name;
            }

            return view('articles.create')->with('categories' ,$categories);
        }
        else
        {
            return redirect('/');
        }
    }

    /**
     * Store a newly created article in storage.
     *
     * @return Redirect to articles or view articles.create with errors
     */
    public function store()
    {
        $request = Request::all();
        $validator = Validator::make($request, Article::$rules);

        if ($validator->passes()) {

            //If no image path is set, set to default image
            if(strlen($request['image_path']) == 0)
            {
                $request['image_path'] = 'no_img.png';
            }

            Article::create($request);

            return redirect('articles');

        } else {

            return back()
                ->withErrors($validator)
                ->withInput();
        }
    }

    /**
     * Display the specified article.
     *
     * @param  int  $id
     * @return return view articles.show with article object and its category object
     */
    public function show($id)
    {
        $article = Article::findOrFail($id);
        $category = Category::findOrFail($article->category_id);

        return view('articles.show')
            ->with('article', $article)->with('category', $category);
    }

    /**
     * Show the form for editing an article.
     *
     * @param  int  $id
     * @return View articles.edit with article object and array of all categories or redirect to start page
     */
    public function edit($id)
    {   
        //
        if(Auth::user()->hasRole('admin'))
        {
            $article = Article::findOrFail($id);
            $categoryArray = Category::orderBy('name', 'asc')->get();
            $categories = array('0' => '--- bitte wählen ---');
            foreach($categoryArray as $category)
            {
                $categories[$category->id] = $category->name;
            }

            return view('articles.edit')
                    ->with('article', $article)
                    ->with('categories' ,$categories);
        }
        else
        {
            return redirect('/');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $request = Request::all();
        $validator = Validator::make($request, Article::$rules);

        if($validator->passes())
        {
            $article = Article::findOrFail($id);
            $article->update($request);

            return redirect('articles');
        }
        else
        {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Article::findOrFail($id)->delete();

        return redirect('articles');
    }
}

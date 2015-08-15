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
        $this->middleware('auth', ['except'=> ['index', 'show']]);
        $this->middleware('admin', ['except' => ['index','show']]);
        $this->middleware('basket');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $articles = Article::all();
        if(Auth::check()) {
            if (Auth::user()->hasRole('admin'))
                return view('articles.list')->with('articles', $articles);
        }
        else
            return view('articles.index')->with('articles', $articles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
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
            return redirect('articles');
        }
        return view('articles.create')->with('categories' ,$categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $request = Request::all();
        $validator = Validator::make($request, Article::$rules);

        if ($validator->passes()) {
            $article = Article::create($request);

            return redirect('articles');

        } else {

            return back()
                ->withErrors($validator)
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $article = Article::findOrFail($id);
        $category = Category::find($article->category_id);

        return view('articles.show')->with('article', $article)->with('category', $category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
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
            return redirect('articles');
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
        $article = Article::findOrFail($id);
        $article->delete();
        
        return redirect('articles');
    }
}

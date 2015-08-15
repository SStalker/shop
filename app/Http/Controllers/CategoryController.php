<?php

namespace App\Http\Controllers;

use App\Category;
use Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Validator;


class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin', ['except'=> ['show']]);
        $this->middleware('basket');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //Get all categories
        $list = Category::all();
        //Return 'Hlist' as hierachy list and 'list' as normal list to index
        return view('categories.index')
            ->with('Hlist', $list->toHierarchy())
            ->with('list', $list);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()

    {
        //Create correct nested list for all categories
        $categories = Category::getNestedList('name', null, '**');
            
        return view('categories.create')->with('categories' ,$categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //Get delivered input
        $request = Request::all();
        $choosedCategory = Category::findOrFail( $request['parent_id'] );

        //Check if all rules are fulfilled
        $validator = Validator::make($request, Category::$rules);

        //
        if ($validator->passes()) {

            //If validator passes create and save new category
            $category = new Category();
            $category->name = $request['name'];
            $category->status = $request['status'];
            $category->save();

            //Set position in hierachie
            switch ($request['type']) {
                case 'root':
                    $category->makeRoot();
                    break;
                case 'child':
                    $category->makeChildof($choosedCategory);
                    break;
                case 'sibling':
                    $category->makeSiblingof($choosedCategory);
                    break;
                default:
                    // todo
                    break;
            }

            return redirect('categories');

        } else {

            //return with errors
            return redirect('categories/create')
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
        $category = Category::findOrFail($id);

        // If category is available
        if ($category->status) 
        {
            // If category ist leaf
            if($category->isLeaf()){
                //Get all articles
                $articles = $category->articles()->get();
            }else{
                //return a selection of articles from all child categories
                $childCategories = Category::find($id)->getDescendants();
                $childArticles = array();
                //Get article of every last child and add it to array
                foreach($childCategories as $child) {
                    foreach ($child->articles as $article) {
                        $childArticles[] = $article;
                    }
                }

                //Get random articles from child categories
                if(count($childArticles) >=3){
                    //Get up to 3 random articles from all child categories if 3 articles are available
                    $articlesIndex = array_rand($childArticles, 3);
                    foreach($articlesIndex as $index){
                        $articles[] = $childArticles[$index];
                    }
                }else{
                    //Get all child articles
                    $articles = $childArticles;
                }
            }
            return view('articles.index')->with('articles', $articles);
        }
        else
        {
            return redirect('/');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        if(Auth::user()->hasRole('admin'))
        {
            //Get right category
            $category = Category::find($id);
            //Create correct nestedlist
            $categories = Category::getNestedList('name', null, '**');

            //return the correct category and a list of all categories
            return view('categories.edit')
                ->with('category', $category)
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
        //Get delivered input
        $request = Request::all();

        //validate input
        $validator = Validator::make($request, Category::$rules);

        if($validator->passes())
        {
            //update
            $category = Category::findOrFail($id);
            $category->name = $request['name'];
            $category->status = $request['status'];
            $category->save();
            
            return redirect('categories');
        }
        else
        {
            //return with errors and without update
            return redirect('articles.edit')
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
        //check if user ist admin
        if (Auth::user()->hasRole('admin')) 
        {
            //Delete article
            Category::findOrFail($id)->delete();
            return redirect('categories');
        }
        else
        {
            //return without deletion
            return redirect('articles');
        }
    }
}

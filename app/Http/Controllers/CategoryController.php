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
     * Display a listing of all categories.
     *
     * @return View categories.index with a hierachy list and a normal list, both with all categories
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
     * Show the form for creating category.
     *
     * @return View categories.create with a nestedList of all categories
     */
    public function create()
    {
        //Create correct nested list for all categories
        $categories = Category::getNestedList('name', null, '**');
            
        return view('categories.create')
                ->with('categories' ,$categories);
    }

    /**
     * Store a newly created category in storage.
     *
     * @return Redirect categories or redirect categories/create with errors and old input
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

            //Set position in hierachie, default is root
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
                    $category->makeRoot();
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
     * Display a category.
     *
     * @param  int  $id as id of a category
     * @return View articles.index with article object or redirect to start page
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
            return view('articles.index')
                    ->with('articles', $articles);
        }
        else
        {
            return redirect('/');
        }
    }

    /**
     * Show the form for editing a category.
     *
     * @param  int  $id as id of the category to edit
     * @return View categories.edit with category object and an nested list of all categories
     */
    public function edit($id)
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

    /**
     * Update a category in storage.
     *
     * @param  int  $id as id of one category
     * @return Redirect categories or redirect categories.edit with errors and old input
     */
    public function update($id)
    {
        //Get delivered input
        $request = Request::all();
        $choosedCategory = Category::findOrFail( $request['parent_id'] );

        //validate input
        $validator = Validator::make($request, Category::$rules);

        if($validator->passes())
        {
            //update
            $category = Category::findOrFail($id);
            $category->name = $request['name'];
            $category->status = $request['status'];
            $category->save();

            if(isset($request['type'])) {
                //Set position in hierachie, default is root
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
                        //                    $category->makeRoot();
                        break;
                }
            }
            
            return redirect('categories');
        }
        else
        {
            //return with errors and without update
            return back()
                ->withErrors($validator)
                ->withInput();
        }
    }

    /**
     * Remove a category from storage.
     *
     * @param  int  $id as id of a category
     * @return redirect
     */
    public function destroy($id)
    {

            //Delete article
            Category::findOrFail($id)->delete();
            return redirect('categories');
    }
}

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

        $list = Category::all();
        //dd($list);
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
        //$categories[] = '--- bitte wählen ---';
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
        $request = Request::all();
        $choosedCategory = Category::findOrFail( $request['parent_id'] );

        $validator = Validator::make($request, Category::$rules);
        //dd($request);
        if ($validator->passes()) {
            
            $category = new Category();
            $category->name = $request['name'];
            $category->status = $request['status'];
            $category->save();

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
            
            // create speichert automatisch den datensatz schon ab
            //$category->save();

            return redirect('categories');

        } else {

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
        if ($category->status) 
        {
            return view('categories.show')
                ->with('category', $category);
        }
        else
        {
            return redirect('categories');
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
        $category = Category::find($id);
        $categories = Category::getNestedList('name', null, '**');


        return view('categories.edit')
            ->with('category', $category)
            ->with('categories' ,$categories);
        }
        else
        {
            return redirect('products');
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
        $validator = Validator::make($request, Category::$rules);

        if($validator->passes())
        {
            $category = Category::findOrFail($id);
            $category->name = $request['name'];
            $category->status = $request['status'];
            $category->save();
            
            return redirect('categories');
        }
        else
        {
            return redirect('products.edit')
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
        if (Auth::user()->hasRole('admin')) 
        {
            Category::findOrFail($id)->delete();
            return redirect('categories');
        }
        else
        {
            return redirect('products');
        }
    }
}

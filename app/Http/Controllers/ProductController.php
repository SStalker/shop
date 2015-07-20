<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\User;
use Request;
use Validator;
use Auth;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except'=> ['index', 'show']]);
        $this->middleware('admin', ['except' => ['index','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $products = Product::all();
        return view('products.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categoryArray = Category::orderBy('name', 'asc')->get();
        $categories = array('0' => '--- bitte wählen ---');

        foreach($categoryArray as $category)        
            $categories[$category->id] = $category->name;
        

        return view('products.create')->with('categories' ,$categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $request = Request::all();
        $validator = Validator::make($request, Product::$rules);

        if ($validator->passes()) {
            $product = Product::create($request);
            //$product->save();

            return redirect('products');

        } else {

            return redirect('products/create')
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
        //ToDo: create show function and view
        return view('products.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categoryArray = Category::orderBy('name', 'asc')->get();
        $categories = array('0' => '--- bitte wählen ---');

        foreach($categoryArray as $category)        
            $categories[$category->id] = $category->name;
        

        return view('products.edit')
                ->with('product', $product)
                ->with('categories' ,$categories);
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
        $validator = Validator::make($request, Product::$rules);

        if($validator->passes())
        {
            $product = Product::update($request);
            //$product->save();

            return redirect('products');
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
        //ToDo: Create destroy function
    }
}

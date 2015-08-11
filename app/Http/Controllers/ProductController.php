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
        $this->middleware('basket');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $products = Product::all();
        if(Auth::check()) {
            if (Auth::user()->hasRole('admin'))
                return view('products.list')->with('products', $products);
        }
        else
            return view('products.index')->with('products', $products);
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

            return view('products.create')->with('categories' ,$categories);
        }
        else
        {
            return redirect('products');
        }
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

            return redirect('products');

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
        $product = Product::findOrFail($id);
        $category = Category::find($product->category_id);
        if ($product->status) 
        {
            return view('products.show')->with('product', $product)->with('category', $category);
        }
        else
        {
            return redirect('products');
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
        //
        if(Auth::user()->hasRole('admin'))
        {
            $product = Product::findOrFail($id);
            $categoryArray = Category::orderBy('name', 'asc')->get();
            $categories = array('0' => '--- bitte wählen ---');
            foreach($categoryArray as $category)
            {
                $categories[$category->id] = $category->name;
            }

            return view('products.edit')
                    ->with('product', $product)
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
        $validator = Validator::make($request, Product::$rules);

        if($validator->passes())
        {
            $product = Product::findOrFail($id);
            $product->update($request);

            return redirect('products');
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
        $product = Product::findOrFail($id);
        $product->delete();
        
        return redirect('products');
    }
}

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
        $this->middleware('auth', ['except'=>'index', 'show']);
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
        if(Auth::user()->hasRole('admin'))
        {
            $categoriyArray = Category::orderBy('category_name', 'asc')->get();
            $categories = array('0' => '--- bitte wählen ---');
            foreach($categoriyArray as $category)
            {
                $categories[$category->id] = $category->category_name;
            }

            return view('products.create')->with('categories' ,$categories);
        }
        else
        {
            return redirect('products');
        }


    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //ToDo : Error Handling
        if(Auth::user()->hasRole('admin'))
        {

            $request = Request::all();

//            dd($request);

            $validator = Validator::make($request, Product::$rules);

            if ($validator->passes()) {
                $product = Product::create($request);
                $product->save();

                return redirect('products');

            } else {

//                dd($validator);
                return redirect('products/create')
                    ->withErrors($validator)
                    ->withInput();
            }
        }
        else
        {
            return redirect('products');
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
        //
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //ToDo : Error Handling
        if(Auth::user()->hasRole('admin'))
        {
            $request = Request::all();
            $validator = Validator::make($request, Product::$rules);

            if($validator->passes())
            {
                $product = Product::update($request);
                $product->save();

                return redirect('products');
            }
            else
            {
                return redirect('products')
                    ->withErrors($validator)
                    ->withInput();
            }
        }
        else
        {
//
            return redirect('products');
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
        //
    }
}

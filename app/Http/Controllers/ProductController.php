<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
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
        // ToDo: Auth. check
        return view('products.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //ToDo : Error Handling, Auth. check
        $validator = Validator::make(Request::all(), Product::$rules);

        if($validator->passes())
        {
            $product = Product::create(Request::all());
            $product->save();

            return redirect('products');
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
        $validator = Validator::make(Request::all(), Product::$rules);

        if($validator->passes())
        {
            $product = Product::update(Request::all());
            $product->save();

            return redirect('products');
        }
        else
        {
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

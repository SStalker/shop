<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class CategoryController extends Controller
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
        $categories = Category::all();
        return view('categories.index')->with('categories', $categories);
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

            return view('categories.create')->with('categories' ,$categories);
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
        if(Auth::user()->hasRole('admin'))
        {

            $request = Request::all();

//            dd($request);

            $validator = Validator::make($request, Category::$rules);

            if ($validator->passes()) {
                $category = Category::create($request);
                // create speichert automatisch den datensatz schon ab
                //$category->save();

                return redirect('categories');

            } else {

//                dd($validator);
                return redirect('categories/create')
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
            $category = Category::findOrFail($id);
            $categoryArray = Category::orderBy('name', 'asc')->get();
            $categories = array('0' => '--- bitte wählen ---');
            foreach($categoryArray as $category)
            {
                $categories[$category->id] = $category->name;
            }

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
        if(Auth::user()->hasRole('admin'))
        {
            $request = Request::all();
            $validator = Validator::make($request, Category::$rules);

            if($validator->passes())
            {
                $category = Category::update($request);
                // update macht das selbe wie create
                //$category->save();

                return redirect('categories');
            }
            else
            {
                return redirect('products.edit')
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
        if (Auth::user()->hasRole('admin')) 
        {
            $category = Category::findOrFail($id);
            $category->delete();
            return redirect('categories');
        }
        else
        {
            return redirect('products');
        }
    }
}

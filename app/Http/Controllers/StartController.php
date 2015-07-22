<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;

class StartController extends Controller
{
	public function __construct()
	{
		$this->middleware('basket');
	}
	
    public function getIndex()
    {    	
    	$categories = Category::all();
    	return view('index')
    		->with('categories', $categories);
    }
}

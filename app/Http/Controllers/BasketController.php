<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BasketController extends Controller
{
	public function __construct()
	{
		$this->middleware('basket');
	}

    public function getIndex()
    {
    	return view('baskets.index');
    }
}

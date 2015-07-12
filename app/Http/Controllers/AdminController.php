<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class AdminController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    	if(!Auth::user() || !Auth::user()->hasRole('admin'))
    	{
    		return "Not admin or unvalid session";
    	}
    }

    public function getIndex()
    {    	
    	return view('backend.index');
    }
}

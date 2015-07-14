<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;
use Auth;
use Validator;
use Hash;

class SettingController extends Controller
{
    public function getIndex()
    {
    	return view('settings.index');
    }

    public function getAccount()
    {
    	return view('settings.account');
    }

    public function getOrder()
    {
    	return view('settings.order');
    }

    public function getPayment()
    {
    	return view('settings.payment');
    }

    public function postUpdateAccount()
    {
    	$user = Auth::user();
    	$request = Request::all();

    	$rules = array(
	        'name' => 'required|alpha_num|min:3|max:32',
	        'email' => 'required|email',
	        'oldpassword' => 'required',
	        'newpassword' => 'min:6|confirmed',
	        'newpassword_confirmation' => 'min:6'
    	);

    	$validator = Validator::make($request, $rules);

    	if($validator->passes())
    	{
	    	if (Hash::check($request['oldpassword'], Auth::user()->password))
	    	{
	    		if($request['newpassword'])
	    		{
	    			// update password
	    			$user->password = bcrypt($request['newpassword']);
	    		}

	    		$user->name = $request['name'];
	    		$user->email = $request['email'];

	    		$user->save();	    		
	    	}
	    	else
	    	{
	    		
		    }
		    return redirect('settings/account')
	    			->withErrors($validator)
	    			->withInput();	    	
	    }
	    else
	    {
	    	return redirect('settings/account')
	    		->withErrors($validator)
	    		->withInput();
	    }
    }
}

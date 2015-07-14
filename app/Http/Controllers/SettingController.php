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
    	$user = Auth::user();
  
    	return view('settings.account')
    		->with('user', $user)
    		->with('addresses', $user->addresses);
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
	        'username' => 'required|alpha_num|min:3|max:32',
	        'email' => 'required|email|unique:users,'.$user->id,
	        'oldpassword' => 'required',
	        'newpassword' => 'min:6|confirmed'
    	);

    	$validator = Validator::make($request, $rules);

    	if($validator->passes())
    	{
	    	if (Hash::check($request['oldpassword'], Auth::user()->password))
	    	{
	    		// Only when a new password is set
	    		if($request['newpassword'])
	    		{
	    			// update password
	    			$user->password = bcrypt($request['newpassword']);
	    		}

	    		$user->username = $request['username'];
	    		$user->email = $request['email'];

	    		$user->update();	    		
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

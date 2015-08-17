<?php

namespace App\Http\Controllers;

use App\Basket;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;
use Auth;
use Validator;
use Hash;
use App\Order;

class SettingController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

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
        // Check if calling user is logged in else return to loggin
        if(Auth::check()){
            $orders = Order::where('user_id', Auth::user()->id)->get();

            return view('settings.order')
                ->with('orders', $orders);
        }else{
            return redirect('/auth/login');
        }

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

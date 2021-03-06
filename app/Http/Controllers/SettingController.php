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


    /**
     * This function redirects to the view for settings account
     *
     * @param
     * @return Redirect settings.account
     *
     */
    public function getIndex()
    {
    	return redirect('settings/account');
    }

    /**
     * This function returns the account view
     *
     * @param
     * @returns View settings.account with user object and addresses array
     *
     * */
    public function getAccount()
    {
    	$user = Auth::user();
  
    	return view('settings.account')
    		->with('user', $user)
    		->with('addresses', $user->addresses);
    }

    /**
     * This function returns all orders of the auth user
     *
     * @param
     * @return View settings.order with an array of orders
     *
     */
    public function getOrder()
    {

        $orders = Order::where('user_id', Auth::user()->id)->get();

        return view('settings.order')
                ->with('orders', $orders);

    }

    /**
     * This function returns the payment view
     *
     * @param
     * @return View settings.payment
     *
     */

    public function getPayment()
    {
    	return view('settings.payment');
    }

    /**
     * This function updates the user information with given input
     *
     * @param
     * @return Redirect to settings/account with errors and old input or redirect to settings/account
     *
     * */

    public function postUpdateAccount()
    {
    	$user = Auth::user();
    	$request = Request::all();

        //Define rules for the input data
    	$rules = array(
	        'username' => 'required|alpha_num|min:3|max:32',
	        'email' => 'required|email|unique:users,'.$user->id,
	        'oldpassword' => 'required',
	        'newpassword' => 'min:6|confirmed'
    	);

    	$validator = Validator::make($request, $rules);

    	if($validator->passes())
    	{
            //Is the input oldpassword correct
	    	if (Hash::check($request['oldpassword'], Auth::user()->password))
	    	{
	    		// Only when a new password is set
	    		if($request['newpassword'])
	    		{
	    			// update password
	    			$user->password = bcrypt($request['newpassword']);
	    		}

                //Update user information
	    		$user->username = $request['username'];
	    		$user->email = $request['email'];

	    		$user->update();

                return redirect('settings/account');
	    	}
	    	else
            {
                $validator->getMessageBag()->add('password', 'Old password wrong');
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }
        }
	    else
	    {
	    	return back()
	    		->withErrors($validator)
	    		->withInput();
	    }

    }
}

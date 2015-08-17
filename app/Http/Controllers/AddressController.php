<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;
use Auth;
use Validator;
use App\Address;

class AddressController extends Controller
{
    /**
     * Unused function.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new adress.
     *
     * @return view settings.addresses.create
     */
    public function create()
    {
        return view('settings.addresses.create');
    }

    /**
     * Store a newly created address in storage.
     *
     * @return Redirect settings/account or redirect addresses/create with errors
     */
    public function store()
    {
        //Get all delivered input into local variable
        $request = Request::all();
        $validator = Validator::make($request, Address::$rules);

        if($validator->passes())
        {
            //Add the user id of the logged in user to
            $request['user_id'] = Auth::user()->id;
            Address::create($request);

            return redirect('settings/account');
        }

        //Return
        return redirect('addresses/create')
            ->withErrors($validator)
            ->withInput();        
    }

    /**
     * Unused function
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing an address.
     *
     * @param  int  $id
     * @return view settings.addresses.edit with address object
     */
    public function edit($id)
    {
        $address = Address::findOrFail($id);

        return view('settings.addresses.edit')
            ->with('address', $address);
    }

    /**
     * Update an address in storage.
     *
     * @param  int  $id
     * @return Redirect settings/account or redirect addresses/edit with errors
     */
    public function update($id)
    {
        //Get all delivered input into local variable
        $request = Request::all();
        $validator = Validator::make($request, Address::$rules);

        if($validator->passes())
        {
            //Update address with new information
            Address::find($id)->update($request);

            return redirect('settings/account');
        }

        return redirect('addresses/'.$id. '/edit')
            ->withErrors($validator)
            ->withInput();        
    }

    /**
     * Remove an address from storage.
     *
     * @param  int  $id
     * @return Redirect settings/account
     */
    public function destroy($id)
    {
        $address = Address::findOrFail($id);        
        $user = $address->user;

        if($user->default_address_id == $id)
        {
            $user->default_address_id = 0;        
        }

        $address->delete();
        return redirect('settings/account');
    }
}

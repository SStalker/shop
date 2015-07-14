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
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('settings.addresses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $request = Request::all();
        $validator = Validator::make($request, Address::$rules);

        if($validator->passes())
        {
            $request['user_id'] = Auth::user()->id;
            Address::create($request);

            return redirect('settings/account');
        }

        return redirect('addresses/create')
            ->withErrors($validator)
            ->withInput();        
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
        $address = Address::findOrFail($id);

        return view('settings.addresses.edit')
            ->with('address', $address);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $request = Request::all();
        $validator = Validator::make($request, Address::$rules);

        if($validator->passes())
        {
            Address::find($id)->update($request);

            return redirect('settings/account');
        }

        return redirect('addresses/create')
            ->withErrors($validator)
            ->withInput();        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
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

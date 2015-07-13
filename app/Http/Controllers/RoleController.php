<?php

namespace App\Http\Controllers;

use Request;
use Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Role;
use Auth;
use Validator;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $roles = Role::all();

        return view('backend.role.list')
            ->with('roles', $roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $request = Request::all();
        $validator = Validator::make($request, Role::$rules);

        if($validator->passes())
            Role::create($request);
        else
            return redirect('roles/create')
                ->withErrors($validator)
                ->withInput();

        return redirect('roles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return redirect('roles');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);

        return view('backend.role.edit')
            ->with('role', $role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $role = Role::findOrFail($id);
        $role->name = Input::get('name');
        $role->display_name = Input::get('display_name');
        $role->description = Input::get('description');
        
        $validator = Validator::make($role->toArray(), Role::$rules);

        if($validator->passes())
            $role->save();
        else
            return redirect('roles/'.$id.'/edit')
                ->withErrors($validator)
                ->withInput(); 


        return redirect('roles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect('roles');
    }
}

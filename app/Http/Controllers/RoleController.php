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
     * Display a listing of all roles.
     *
     * @return View backend.role.list with all roles
     */
    public function index()
    {
        $roles = Role::all();

        return view('backend.role.list')
            ->with('roles', $roles);
    }

    /**
     * Show the form for creating a new role.
     *
     * @return View backend.role.create
     */
    public function create()
    {
        return view('backend.role.create');
    }

    /**
     * Store a newly created role in storage.
     *
     * @return Redirect roles/create with errors and old input or redirect to index
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
     * Display the specified role. Currently unused function.
     *
     * @param  int  $id
     * @return Redirect to index
     */
    public function show($id)
    {
        return redirect('roles');
    }

    /**
     * Show the form for editing a role.
     *
     * @param  int  $id as id of a role
     * @return View backend.role.edit with a role object
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);

        return view('backend.role.edit')
            ->with('role', $role);
    }

    /**
     * Update the specified role in storage.
     *
     * @param  int  $id as id of a role
     * @return Redirect back with errors and old input or redirect to index
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
            return back()
                ->withErrors($validator)
                ->withInput(); 


        return redirect('roles');
    }

    /**
     * Remove a role from storage.
     *
     * @param  int  $id as id of a role
     * @return Redirect to index
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect('roles');
    }
}

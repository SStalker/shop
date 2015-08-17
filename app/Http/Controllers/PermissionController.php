<?php

namespace App\Http\Controllers;

use Request;
use Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Permission;
use Auth;
use Validator;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }


    /**
     * Display a listing of all permissions.
     *
     * @return View backend.permission.list with all permissions
     */
    public function index()
    {
        $permissions = Permission::all();

        return view('backend.permission.list')
            ->with('permissions', $permissions);
    }

    /**
     * Show the form for creating a new permission.
     *
     * @return View backend.permission.create
     */
    public function create()
    {
        return view('backend.permission.create');
    }

    /**
     * Store a newly created permission in storage.
     *
     * @return Redirect permissions/create with errors and old input or redirect to permissions
     */
    public function store()
    {
        $request = Request::all();
        $validator = Validator::make($request, Permission::$rules);

        if($validator->passes())
            Permission::create($request);
        else
            return redirect('permissions/create')
                ->withErrors($validator)
                ->withInput();

        return redirect('permissions');
    }

    /**
     * Display a permission. Currently unused with redirect to index
     *
     * @param  int  $id as id of the permission
     * @return Redirect  permissions
     */
    public function show($id)
    {
        return redirect('permissions');
    }

    /**
     * Show the form for editing the specified permission.
     *
     * @param  int  $id as id of the permission
     * @return View backend.permission.edit with permission object
     */
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);

        return view('backend.permission.edit')
            ->with('permission', $permission);
    }

    /**
     * Update the permission in storage.
     *
     * @param  int  $id as permission id
     * @return Redirect back with errors and old input or redirect to index
     */
    public function update($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->name = Input::get('name');
        $permission->display_name = Input::get('display_name');
        $permission->description = Input::get('description');
        
        $validator = Validator::make($permission->toArray(), Permission::$rules);

        if($validator->passes())
            $permission->save();
        else
            return back()
                ->withErrors($validator)
                ->withInput(); 


        return redirect('permissions');
    }

    /**
     * Remove the permission from storage.
     *
     * @param  int  $id as permission id
     * @return Redirect to index
     */
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
        return redirect('permissions');
    }
}

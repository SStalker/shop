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
        $user = Auth::user();

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
        $permissions = Permission::all();

        return view('backend.permission.list')
            ->with('permissions', $permissions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return redirect('permissions');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);

        return view('backend.permission.edit')
            ->with('permission', $permission);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
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
            return redirect('permissions/'.$id.'/edit')
                ->withErrors($validator)
                ->withInput(); 


        return redirect('permissions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
        return redirect('permissions');
    }
}

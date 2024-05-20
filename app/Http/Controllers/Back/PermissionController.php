<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::paginate(6);
        return view('back.permission.index',compact('permissions'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data =  $request->validate([
            'name'=>'required|string|max:255|unique:permissions,name',
            'guard_name'=>'required|string|max:255',
        ]);
   

        // $data['guard_name'] = 'admin';
         Permission::create($data);

        return redirect(route('permissions.index'))->with(['success'=>'permission Created successfuly']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
    //    return $permission;
        return view('back.permission.edit',compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data =  $request->validate([
            'name'=>'required|string|max:255'
        ]);
        $permission = permission::findOrFail($id);
        // $data['guard_name'] = 'admin';
        $permission->update($data);
        return redirect()->route('permissions.index')->with(['success'=>'permission update successfuly']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $permissionId)
    {
        $permission = Permission::findOrFail($permissionId);
        $permission->delete();
        return to_route('permissions.index')->with(['success'=>'permission deleted successfuly']);
    }
}

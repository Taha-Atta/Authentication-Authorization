<?php

namespace App\Http\Controllers\Back;


use App\Models\Admin;
use App\Mail\adminWelcome;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\AdminRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateAdminRequest;

class AdminController extends Controller
{
    // public function __construct()
    // {
    //     // $this->middleware('role:super-admin');
    //     $this->middleware('permission:update admin', ['only' => ['update', 'edit',]]);
    //     $this->middleware('permission:delete admin', ['only' => ['destroy']]);
    //     $this->middleware('permission:create admin', ['only' => ['create', 'store']]);
    //     $this->middleware('permission:show admin', ['only' => ['index']]);
    // }
    public function index()
    {
        $admins = Admin::all();

        return view('back.Admin.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::where('guard_name','admin')->get();
        return view('back.Admin.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $request)
    {

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),


        ]);




        $admin->syncRoles($request->roles);
        // Mail::to($admin->email)->send(new adminWelcome($admin));
        return redirect(route('back.admins.index'))->with('success', "data insert successfuly");
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
    public function edit(admin $admin)
    {


        $adminRoles = $admin->roles->pluck('name', 'name')->all();

        $roles = Role::pluck('name', 'name')->all();
        return view('back.Admin.edit', compact('admin', 'roles', 'adminRoles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdminRequest $request, string $id)
    {

        $admin = admin::findOrFail($id);

        $admin->update([
            'name' => $request->name,
            'email' => $request->email,

        ]);

        if ($request->has('password')) {
            $admin->update([
                'password' => bcrypt($request->password),
            ]);
        }

        $admin->syncRoles($request->roles);
        return redirect()->route('back.admins.index')->with('success', 'admin update successfuly');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($adminId)
    {
        $admin = admin::findOrFail($adminId);

        $adminRoles = $admin->roles->pluck('name', 'name')->all();

        foreach ($adminRoles as $adminRole) {

            $admin->removeRole($adminRole);
        }

        $admin->delete();

        return redirect()->route('back.admins.index')->with('success', 'admin deleted successfuly');
    }
}

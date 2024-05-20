<?php

namespace App\Http\Controllers\Back;



use App\Models\User;
use App\Mail\userWelcome;
use Illuminate\Http\Request;
use App\Http\Requests\userRequest;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateuserRequest;

class UserController extends Controller
{
    // public function __construct()
    // {
    //     // $this->middleware('role:super-user');
    //     $this->middleware('permission:update user', ['only' => ['update', 'edit',]]);
    //     $this->middleware('permission:delete user', ['only' => ['destroy']]);
    //     $this->middleware('permission:create user', ['only' => ['create', 'store']]);
    //     $this->middleware('permission:show user', ['only' => ['index']]);
    // }
    public function index()
    {
        $users = User::all();

        return view('back.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Gate::authorize('add');
        $roles = Role::where('guard_name','web')->get();
        return view('back.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $user = user::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),


        ]);




        $user->syncRoles($request->roles);
        // Mail::to($user->email)->send(new userWelcome($user));
        return redirect(route('back.users.index'))->with('success', "data insert successfuly");
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
    public function edit(user $user)
    {


        $userRoles = $user->roles->pluck('name', 'name')->all();

        // $roles = Role::pluck('name', 'name')->all();
        $roles = Role::where('guard_name','web')->get();
        return view('back.user.edit', compact('user', 'roles', 'userRoles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $user = user::findOrFail($id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,

        ]);

        if ($request->has('password')) {
            $user->update([
                'password' => bcrypt($request->password),
            ]);
        }

        $user->syncRoles($request->roles);
        return redirect()->route('back.users.index')->with('success', 'user update successfuly');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($userId)
    {
        $user = user::findOrFail($userId);

        $userRoles = $user->roles->pluck('name', 'name')->all();

        foreach ($userRoles as $userRole) {

            $user->removeRole($userRole);
        }

        $user->delete();

        return redirect()->route('back.users.index')->with('success', 'user deleted successfuly');
    }
}

<?php

namespace App\Http\Controllers\Admin\Backend;

use App\Models\user;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = user::orderBy('updated_at', 'DESC')->orderBy('created_at', 'DESC')->get();
        return view('admin.backend.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.backend.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
            'role_as' => ['required', 'integer'],
            'phone' => ['required', 'string', 'regex:/^\+?\d{10,15}$/'],
            'postal_code' => ['required', 'integer', 'digits:6'],
            'address' => ['required', 'string', 'max:499']
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_as' => $request->role_as
        ]);

        UserDetail::create([
            'user_id' => $user->id,
            'phone' => $request->phone,
            'postal_code' => $request->postal_code,
            'address' => $request->address
        ]);

        return redirect('ecommerce/admin/users')->with('message', 'User is added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(user $user)
    {
        return view('admin.backend.users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(user $user)
    {
        return view('admin.backend.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, user $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            // 'email' => [
            //     'required',
            //     'string',
            //     'email',
            //     'max:255',
            //     Rule::unique('users')->ignore($user->id)
            // ],
            'password' => ['required', 'string', 'min:6'],
            'role_as' => ['required', 'integer'],
            'phone' => ['required', 'string', 'regex:/^\+?\d{10,15}$/'],
            'postal_code' => ['required', 'integer', 'digits:6'],
            'address' => ['required', 'string', 'max:499']
        ]);
        $user->update([
            'name' => $request->name,
            // 'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_as' => $request->role_as
        ]);
        $user->userDetail->update([
            // 'user_id' => $user->id,
            'phone' => $request->phone,
            'postal_code' => $request->postal_code,
            'address' => $request->address
        ]);

        return redirect('ecommerce/admin/users')->with('message', 'User is updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(user $user)
    {
        $user->delete();
        return response()->json(['message' => 'User and other related details such as wishlist, cart, orders are deleted successfully!']);
    }
}

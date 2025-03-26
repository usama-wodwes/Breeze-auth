<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin'); // Restrict access to admins only
    }

    // ✅ View All Users (Admin Only)
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    // ✅ Show Create User Form (Admin Only)
    public function create()
    {
        return view('admin.users.create');
    }

    // ✅ Store New User (Admin Only)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:user,admin'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    // ✅ Show Edit User Form (Admin Only)
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }



    // ✅ Update User (Admin Only)
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:user,admin', // Validate role
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Assign the new role (Spatie handles roles this way)
        $user->syncRoles([$request->role]);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }


    // ✅ Delete User (Admin Only)
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}

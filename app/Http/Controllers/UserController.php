<?php
// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('employee', 'roles')->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $employees = Employee::all();
        $roles = Role::all();
        return view('users.create', compact('employees', 'roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|confirmed|min:8',
            'employee_id' => 'required|exists:employees,id',
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'employee_id' => $request->employee_id,
            'password' => Hash::make($request->password),
        ]);

        $user->roles()->attach($request->role_id); // or ->assignRole() if using Spatie

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        $employees = Employee::all();
        $roles = Role::all();
        return view('users.edit', compact('user', 'employees', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|string|email|max:255|unique:users,email,{$user->id}",
            'employee_id' => 'required|exists:employees,id',
            'role_id' => 'required|exists:roles,id',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'employee_id' => $request->employee_id,
        ]);

        $user->roles()->sync([$request->role_id]);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }


public function security(User $user)
{
    return view('users.security', compact('user'));
}

public function resetPassword(Request $request, User $user)
{
    $request->validate([
        'password' => ['required', 'confirmed', 'min:8'],
    ]);

    $user->update([
        'password' => Hash::make($request->password),
    ]);

    return back()->with('success', 'Password reset successfully.');
}

public function toggleBlock(User $user)
{
    $user->update([
        'is_blocked' => !$user->is_blocked,
    ]);

    return back()->with('success', $user->is_blocked ? 'User has been blocked.' : 'User has been unblocked.');
}

}

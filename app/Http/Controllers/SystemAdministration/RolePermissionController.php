<?php
namespace App\Http\Controllers\SystemAdministration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all();
        $users = User::all();
        return view('system_administration.roles_permissions.index', compact('roles', 'permissions', 'users'));
    }

    public function storeRole(Request $request)
    {
        $request->validate(['name' => 'required|unique:roles,name']);
        Role::create(['name' => $request->name]);
        return back()->with('success', 'Role created.');
    }

    public function storePermission(Request $request)
    {
        $request->validate(['name' => 'required|unique:permissions,name']);
        Permission::create(['name' => $request->name]);
        return back()->with('success', 'Permission created.');
    }

public function assignPermission(Request $request)
{
    $request->validate([
        'role_id' => 'required|exists:roles,id',
        'permission_id' => 'required|exists:permissions,id',
    ]);
    $role = Role::findById($request->role_id);
    $permission = \Spatie\Permission\Models\Permission::findById($request->permission_id);
    $role->givePermissionTo($permission->name);
    return back()->with('success', 'Permission assigned to role.');
}

    public function assignRole(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:roles,id',
        ]);
        $user = User::findOrFail($request->user_id);
      
$role = \Spatie\Permission\Models\Role::findById($request->role_id);
        
$user->assignRole($role->name);
        return back()->with('success', 'Role assigned to user.');
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SaveRoleRequest;
use App\Http\Requests\AssignRolePermissionsRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all();

        return view('admin.roles.index', compact('roles', 'permissions'));
    }

    public function store(SaveRoleRequest $request)
    {
        Role::create(['name' => $request->name]);

        return back()->with('success', 'Role successfully created.');
    }

   
    public function assignPermissions(AssignRolePermissionsRequest $request, Role $role)
    {
        $role->syncPermissions($request->permissions ?? []);

        return back()->with('success', 'Permissions updated for role: ' . $role->name);
    }

    
}

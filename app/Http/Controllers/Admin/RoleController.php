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
        abort_unless(auth('admin')->user()->can('create roles'), 403);

        Role::create(['name' => $request->name]);

        return back()->with('success', 'Role successfully created.');
    }

   
    public function assignPermissions(AssignRolePermissionsRequest $request, Role $role)
    {
        abort_unless(auth('admin')->user()->can('assign permissions'), 403);

        $role->syncPermissions($request->permissions ?? []);

        return back()->with('success', 'Permissions updated for role: ' . $role->name);
    }

    public function show(Role $role)
    {
        $permissions = Permission::all();

        return view('admin.roles.show', compact('role', 'permissions'));
    }

    public function edit(Role $role)
    {
        abort_unless(auth('admin')->user()->can('edit roles'), 403);

        return view('admin.roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        abort_unless(auth('admin')->user()->can('edit roles'), 403);

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $role->update(['name' => $request->name]);

        return redirect()->route('admin.roles.index')->with('success', 'Role name updated successfully.');
    }

    public function delete(Role $role)
    {
        abort_unless(auth('admin')->user()->can('delete roles'), 403);

        $role->delete();

        return redirect()->route('admin.roles.index')->with('success', 'Role deleted successfully.');
    }

}

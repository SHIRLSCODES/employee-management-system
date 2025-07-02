<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;
use App\Models\Admin;
use Spatie\Permission\Models\Role;

class RoleAssignmentController extends Controller
{
    public function index()
    {
        $admins = Admin::with('roles')->get();
        $employees = Employee::with('roles')->get();
        $roles = Role::all();

        return view('admin.roles.assign-roles', compact('admins', 'employees', 'roles'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'user_type' => 'required|in:admin,employee',
            'user_id' => 'required|integer',
            'role' => 'required|string',
        ]);

        if ($request->user_type === 'admin') {
            $user = \App\Models\Admin::findOrFail($request->user_id);
            $guard = 'admin';
        } else {
            $user = \App\Models\Employee::findOrFail($request->user_id);
            $guard = 'employee';
        }

        $role = Role::where('name', $request->role)
                    ->where('guard_name', $guard)
                    ->firstOrFail();

        $user->assignRole($role);

        return back()->with('success', "Role '{$role->name}' assigned to {$user->name}");
    }

}

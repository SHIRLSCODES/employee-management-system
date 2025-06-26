<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaveAdminRequest;
use Exception;
use Log;
use App\Models\Department;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
      public function index(Request $request)
    {
        $query = Admin::query();

        if ($request->filled('department')) {
            $query->where('department_id', $request->department);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $admins = $query->paginate(5)->withQueryString();

        // $adminToUpdate = Admin::find(4);
        // if ($adminToUpdate) {
        //     $adminToUpdate->assignRole('stock-manager');
        // }

        $departments = Department::get();

        return view('admin.admin.index', compact('admins', 'departments'));
    }

    public function create()
    {
        $departments = Department::all();

        return view('admin.admin.create', compact('departments'));
    }

    public function store(SaveAdminRequest $request)
    {
        $validated = $request->validated();

        $plainPassword = $validated['password'];

        $validated['password'] = Hash::make($plainPassword);

        $admin = Admin::create($validated);
        
        $department = $admin->department->name;

        if ($department === 'Finance') {
            $admin->assignRole('finance-admin');
        }

        return redirect()->route('admin.admin.create')->with('success', 'Admin created successfully.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $admins = Admin::where('name', 'like', "%{$query}%")->orWhere('email', 'like', "%{$query}%")->get();

        // Return partial HTML to update the table
        return response()->json([
            'html' => view('partials.admin.admin-rows', compact('admins'))->render()
            ]);
    }
}



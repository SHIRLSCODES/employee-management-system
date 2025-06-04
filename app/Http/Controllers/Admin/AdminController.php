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
    public function index()
    {
        return view('admin.admin.index');
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

        return redirect()->route('admin.admin.create')->with('success', 'Admin created successfully.');
    }
}



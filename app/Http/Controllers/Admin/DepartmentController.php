<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function show($department)
    {
        $employees = Employee::where('department', $department)->get();
        
        return view('admin.departments.show', compact('employees', 'department'));
    }
}


<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function show($department)
    {
        $employees = Employee::where('department', $department)->get();
        
        return view('departments.show', compact('employees', 'department'));
    }
}


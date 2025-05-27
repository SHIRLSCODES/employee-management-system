<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(Request $request) {
        $query = Employee::query();

        if ($request->filled('department')) {
            $query->where('department', $request->department);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $employees = $query->paginate(5)->withQueryString();

        $departments = Employee::select('department')->distinct()->pluck('department');

        return view('admin.dashboard', compact('employees', 'departments'));
    }
}
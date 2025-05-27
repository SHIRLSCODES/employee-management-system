<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Http\Requests\SaveEmployeeRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\SaveEmployeeUpdateRequest;

class EmployeeController extends Controller
{
    public function dashboard()
    {
        return view('employee.dashboard');
    }

    public function index(Request $request)
    {
        $query = Employee::query();

        if ($request->filled('department')) {
            $query->where('department', $request->department);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $employees = $query->paginate(5)->withQueryString();

        $departments = Employee::select('department')->distinct()->pluck('department');

        return view('employee.index', compact('employees', 'departments'));
    }


    public function create()
    {
        return view('employee.create');
    }

    public function store(SaveEmployeeRequest $request)
    {
        
        $employee = $request->validated();

        $employee['password'] = Hash::make($employee['password']);

        $employee = Employee::create($employee);

        return redirect()->route('employee.index')->with('success','Employee created successfully');
    }

    public function show(Employee $employee)
    {
        return view('employee.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        return view('employee.edit', compact('employee'));
    }

    public function update(SaveEmployeeUpdateRequest $request, Employee $employee)
    {
        $employee->update($request->validated());

        return redirect()->route('employee.index')->with('success', 'Employee updated successfully');
    }


    public function delete($id)
    {
        $employee = Employee::findOrFail($id);

        $employee->delete();

        return redirect()->route('employee.index')->with('success', 'Employee deleted successfully');
    }

    public function search(Request $request)
        {
            $query = $request->input('query');

            $employees = Employee::where('first_name', 'like', "%{$query}%")
                        ->orWhere('last_name', 'like', "%{$query}%")
                        ->orWhere('email', 'like', "%{$query}%")
                        ->get();

            // Return partial HTML to update the table
            return response()->json([
                'html' => view('partials.employee-rows', compact('employees'))->render()
            ]);
        }
}

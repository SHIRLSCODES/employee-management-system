<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Employee;
use App\Mail\WelcomeEmployeeMail;
use App\Http\Requests\SaveEmployeeRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\SaveEmployeeUpdateRequest;

class EmployeeController extends Controller
{
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

  

        $departments = Department::get();

        return view('admin.employee.index', compact('employees', 'departments'));
    }


    public function create()
    {
        $departments = Department::where([['status', 'active']])->get();
        return view('admin.employee.create', compact('departments'));
    }

    public function store(SaveEmployeeRequest $request)
    {
        
        $validated = $request->validated();

        $plainPassword = $validated['password'];

        $validated['password'] = Hash::make($plainPassword);

        $employee = Employee::create($validated);

        $admin = auth('admin')->user();

        Mail::to($employee->email)->send(new WelcomeEmployeeMail($employee, $plainPassword, $admin));


        return redirect()->route('admin.employee.index')->with('success','Employee created successfully');
    }

    public function show(Employee $employee)
    {
        return view('admin.employee.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        $departments = Department::where([['status', 'active']])->get();
        return view('admin.employee.edit', compact('employee', 'departments'));
    }

    public function update(SaveEmployeeUpdateRequest $request, Employee $employee)
    {
        $employee->update($request->validated());

        return redirect()->route('admin.employee.index')->with('success', 'Employee updated successfully');
    }


    public function delete($id)
    {
        $employee = Employee::findOrFail($id);

        $employee->delete();

        return redirect()->route('admin.employee.index')->with('success', 'Employee deleted successfully');
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
                'html' => view('partials.admin.employee-rows', compact('employees'))->render()
            ]);
        }
}

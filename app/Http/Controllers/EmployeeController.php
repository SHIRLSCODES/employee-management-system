<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Http\Requests\SaveEmployeeRequest;
use App\Http\Requests\SaveEmployeeUpdateRequest;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::paginate(10);

        return view('employee.index', compact('employees'));
    }


    public function create()
    {
        return view('employee.create');
    }

    public function store(SaveEmployeeRequest $request)
    {
        $employee = Employee::create($request ->validated());

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
}

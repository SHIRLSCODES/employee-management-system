<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveDepartmentRequest;
use App\Http\Requests\SaveDepartmentUpdateRequest;
use App\Models\Department;
use App\Models\Employee;
use Exception;
use Illuminate\Http\Request;
use Log;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::latest()->paginate(30);

        return view('admin.departments.index', compact('departments'));
    }

    public function show(Department $department)
    {
        $employees = $department->employees;
        
        return view('admin.departments.show', compact('employees', 'department'));
    }

    public function create()
    {
        return view('admin.departments.create');
    }

    public function store(SaveDepartmentRequest $request)
    {
        try{
            $validated = $request->validated();
            $currentUser = auth()->user();

            $validated['created_by'] = $currentUser->id;
            $validated['last_updated_by'] =  $currentUser->id;
            $create = Department::create($validated);
            return redirect()->route('admin.departments.index')->with('success', 'Department created successfully');
        }
        catch(Exception $e)
        {
            Log::error('Admin DepartmentController Store Error: '.$e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function edit(Department $department)
    {
        return view('admin.departments.edit', compact('department'));
    }
    
    public function update(SaveDepartmentUpdateRequest $request, Department $department)
    {
        try{
            $validated = $request->validated();
            $currentUser = auth()->user();

            $validated['last_updated_by'] =  $currentUser->id;
            $update = $department->update($validated);

            if(!$update)
            {
                return redirect()->back()->withInput()->with('error', 'Could not update department, please try again');
            }

            return redirect()->route('admin.departments.index')->with('success', 'Department updated successfully');
        }catch(Exception $e)
        {
            Log::error('Admin DepartmentController Store Error: '.$e->getMessage());
            return redirect()->back()->withInput()->with('error', 'An unexpected Error occured, please try again');
        }
    }
    public function search(Request $request)
        {
            $query = $request->input('query');

            $departments = Department::where('name', 'like', "%{$query}%")
                        ->orWhere('code', 'like', "%{$query}%")
                        ->get();

            return response()->json([
                'html' => view('partials.admin.department-rows', compact('departments'))->render()
            ]);
        }
}


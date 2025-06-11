<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LeaveRequest;
use App\Models\Employee;
use Exception;
use Log;
use App\Http\Requests\SaveLeaveRequest;

class LeaveController extends Controller
{
    public function index()
    {
        $leaveRequests = LeaveRequest::paginate(5);

        return view('admin.leaves.index', compact('leaveRequests'));
    }

    public function approve(LeaveRequest $leave){
        $leave->status = 'approved';

        $leave->save();

        return redirect()->back()->with('success', 'Leave request approved.');
    }

    public function deny(LeaveRequest $leave){
        $leave->status = 'denied';

        $leave->save();

        return redirect()->back()->with('success', 'Leave request denied.');
    }

    public function create()
    {
        if (auth()->user()->leaveBalance() <= 0) {
            return redirect()->route('admin.leaves.index')->with('error', 'You have used all your leave days.');
        }
        return view('admin.leaves.create');
    }

    public function store(SaveLeaveRequest $request)
    {
        $data = $request->validated();

        $data['admin_id'] = auth()->id();

        $leaveRequests = LeaveRequest::create($data);

        return redirect()->route('admin.leaves.index')->with('success', 'Your leave request has been submitted successfully.');
    }

    public function show(LeaveRequest $leave)
    {
        return view('admin.leaves.show', compact('leave'));
    }

    public function edit(LeaveRequest $leave)
    {
         if (in_array($leave->status, ['approved', 'denied'])) {
            abort(403, 'You cannot edit a leave request that has been approved or denied.');
        }
        if (auth()->id() !== $leave->admin_id) {
            abort(403, 'Unauthorized action, you cannot view this page');
        }
        return view('admin.leaves.edit', compact('leave'));
    }

    public function update(SaveLeaveRequest $request, LeaveRequest $leave)
    {
        $data = $request->validated();

        $leave->update($data);

        return redirect()->route('admin.leaves.index')->with('success', 'Your leave request has been updated successfully.');
    }
    
    public function destroy(LeaveRequest $leave)
    {
        $leave->delete();

        return redirect()->route('admin.leaves.index')->with('success', 'Your leave request has been deleted successfully.');
    }

    public function setup()
    {
        if (!auth()->guard('admin')->check()) {
            abort(403, 'Unauthorized action. You cannot view this page.');
        }

        $employees = Employee::paginate(5);

        return view('admin.leaves.setup', compact('employees'));
    }

    public function updateLeaveDays(Request $request, Employee $employee)
    {
        $request->validate([
            'total_leave_days' => 'required|integer|min:0',
        ]);

        $employee->update([
            'total_leave_days' => $request->total_leave_days,
        ]);

        return redirect()->route('admin.leaves.setup')->with('success', 'Leave days updated for ' . $employee->first_name);
    }
    
    public function updateAllEmployees(Request $request)
    {
        $request->validate([
            'total_leave_days' => 'required|integer|min:0',
        ]);

        Employee::query()->update(['total_leave_days' => $request->total_leave_days]);

        return redirect()->route('admin.leaves.setup')->with('success', 'Leave days updated for all employees.');
    }

}

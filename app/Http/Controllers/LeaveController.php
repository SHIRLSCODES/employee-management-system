<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeaveRequest;
use App\Http\Requests\SaveLeaveRequest;

class LeaveController extends Controller
{
    public function index()
    {
        $leaveRequests = LeaveRequest::where('employee_id', auth()->id())->latest()->paginate(5);

        return view('leaves.index', compact('leaveRequests'));
    }

    public function create()
    {
       return view('leaves.create');
    }

    public function store(SaveLeaveRequest $request)
    {
        $data = $request->validated();

        $data['employee_id'] = auth()->id();

        $leaveRequests = LeaveRequest::create($data);

        return redirect()->route('leaves.index')->with('success', 'Your leave request has been submitted successfully.');
    }

    public function show(LeaveRequest $leave)
    {
        return view('leaves.show', compact('leave'));
    }

    public function edit(LeaveRequest $leave)
    {
        if (in_array($leave->status, ['approved', 'denied'])) {
            abort(403, 'You cannot edit a leave request that has been approved or denied.');
        }
        if (auth()->id() !== $leave->employee_id) {
            abort(403, 'Unauthorized action, you cannot view this page');
        }
        return view('leaves.edit', compact('leave'));
    }

    public function update(SaveLeaveRequest $request, LeaveRequest $leave)
    {
        $data = $request->validated();

        $leave->update($data);

        return redirect()->route('leaves.index')->with('success', 'Your leave request has been updated successfully.');
    }
    
    public function destroy(LeaveRequest $leave)
    {
        $leave->delete();

        return redirect()->route('leaves.index')->with('success', 'Your leave request has been deleted successfully.');
    }
}

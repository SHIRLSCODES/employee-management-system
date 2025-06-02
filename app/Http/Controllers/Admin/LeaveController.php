<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LeaveRequest;
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
       return view('admin.leaves.create');
    }

    public function store(SaveLeaveRequest $request)
    {
        $data = $request->validated();

        $data['employee_id'] = auth()->id();

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
}

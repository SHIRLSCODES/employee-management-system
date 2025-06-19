<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Http\Requests\SaveAttendanceRequest;

class AttendanceController extends Controller
{
    public function index()
    {
        $employee = auth()->user();
        $userType = 'App\Models\Employee';

        $attendanceRecords = Attendance::where('attendable_type', $userType)
                                      ->where('attendable_id', $employee->id)
                                      ->orderBy('attendance_date', 'desc')
                                      ->paginate(5);

        return view('attendance.index', compact('attendanceRecords'));
    }
    public function checkIn()
    {
        return view('attendance.checkIn');
    }
    public function checkOut()
    {
        return view('attendance.checkOut');
    }

    public function create(SaveAttendanceRequest $request)
    {
        $employee = auth()->user();
        $userType = 'App\Models\Employee';

        $validated = $request->validated();
        $today = now()->toDateString();

        $existing = Attendance::where('attendable_type', $userType)
                             ->where('attendable_id', $employee->id)
                             ->where('attendance_date', $today)
                             ->first();

        if ($existing) {
            return back()->with('error', 'You have already checked in today.');
        }

        Attendance::create([
            'attendable_type' => $userType,
            'attendable_id' => $employee->id,
            'branch' => $validated['branch'],
            'attendance_date' => $validated['attendance_date'],
            'check_in' => now()->toTimeString(),
        ]);
        
        return redirect()->route('attendance.index')->with('success', 'Checked in successfully.');
    }

    public function edit(SaveAttendanceRequest $request)
    {
        $employee = auth()->user();
        $userType = 'App\Models\Employee';
        $today = now()->toDateString();

        $attendance = Attendance::where('attendable_type', $userType)
                               ->where('attendable_id', $employee->id)
                               ->where('attendance_date', $today)
                               ->first();

        if (!$attendance) {
            return back()->with('error', 'No check-in record found for today. Please check in first.');
        }

        if ($attendance->check_out) {
            return back()->with('error', 'You have already checked out today.');
        }

        $attendance->update([
            'check_out' => now()->toTimeString(),
        ]);

        return redirect()->route('attendance.index')->with('success', 'Checked out successfully.');
    }
}

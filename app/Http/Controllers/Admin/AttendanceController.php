<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Http\Requests\SaveAttendanceRequest;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendanceRecords = Attendance::paginate(5);

        return view('admin.attendance.index', compact('attendanceRecords'));
    }
    public function adminIndex()
    {
        $admin = auth('admin')->user();
        $userType = 'App\Models\Admin';

        $attendanceRecords = Attendance::where('attendable_type', $userType)
                                      ->where('attendable_id', $admin->id)
                                      ->orderBy('attendance_date', 'desc')
                                      ->paginate(5);

        return view('admin.attendance.admin-index', compact('attendanceRecords'));
    }
    public function checkIn()
    {
        return view('admin.attendance.checkIn');
    }
    public function checkOut()
    {
        return view('admin.attendance.checkOut');
    }

    public function create(SaveAttendanceRequest $request)
    {
        $admin = auth('admin')->user();
        $userType = 'App\Models\Admin';

        $validated = $request->validated();
        $today = now()->toDateString();

        $existing = Attendance::where('attendable_type', $userType)
                             ->where('attendable_id', $admin->id)
                             ->where('attendance_date', $today)
                             ->first();

        if ($existing) {
            return back()->with('error', 'You have already checked in today.');
        }

        Attendance::create([
            'attendable_type' => $userType,
            'attendable_id' => $admin->id,
            'branch' => $validated['branch'],
            'attendance_date' => $validated['attendance_date'],
            'check_in' => now()->toTimeString(),
        ]);
        return redirect()->route('admin.attendance.checkIn')->with('success', 'Checked in successfully.');
    }

    public function edit(SaveAttendanceRequest $request)
    {
        $admin = auth('admin')->user();
        $userType = 'App\Models\Admin';
        $today = now()->toDateString();

        $attendance = Attendance::where('attendable_type', $userType)
                               ->where('attendable_id', $admin->id)
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

        return redirect()->route('admin.attendance.checkOut')->with('success', 'Checked out successfully.');
    }
}

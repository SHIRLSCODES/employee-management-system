<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Http\Requests\SaveAttendanceRequest;
use App\Mail\LateAttendanceQueryMail;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendanceRecords = Attendance::with('attendable')
            ->orderBy('attendance_date', 'desc')
            ->paginate(5);
        
        $attendanceRecords->getCollection()->transform(function ($attendance) {
            // Check if attendable relationship exists
            if ($attendance->attendable) {
                $lateCount = Attendance::where('attendable_type', get_class($attendance->attendable))
                    ->where('attendable_id', $attendance->attendable->id)
                    ->whereMonth('attendance_date', now()->month)
                    ->whereYear('attendance_date', now()->year)
                    ->get()
                    ->filter(fn ($record) => $record->is_late)
                    ->count();
                
                $attendance->late_count = $lateCount;
            } else {
                // Handle case where attendable is null
                $attendance->late_count = 0;
            }
            
            return $attendance;
        });
        
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

    public function issueLateQuery(Attendance $attendance){
        $employee = $attendance->attendable;

        $admin = auth('admin')->user();

        $lateCount = Attendance::where('attendable_type', get_class($employee))
            ->where('attendable_id', $employee->id)
            ->whereMonth('attendance_date', now()->month)
            ->whereYear('attendance_date', now()->year)
            ->get()
            ->filter(function ($record) {
                return $record->is_late;
            })->count();

        if ($lateCount < 3) {
            return back()->with('error', 'User has not reached 3 lateness occurrences this month.');
        }

        Mail::to($employee->email)->send(new LateAttendanceQueryMail($employee, $admin, $lateCount));

        return back()->with('success', 'Query issued successfully.');
    }
    
}
